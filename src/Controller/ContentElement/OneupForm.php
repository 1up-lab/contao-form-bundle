<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Controller\ContentElement;

use Contao\ContentModel;
use Contao\CoreBundle\Controller\ContentElement\AbstractContentElementController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsContentElement;
use Contao\CoreBundle\Twig\FragmentTemplate;
use Oneup\ContaoFormBundle\Event\PostSubmitEvent;
use Oneup\ContaoFormBundle\Model\FormModel;
use Oneup\ContaoFormBundle\Service\FormBuilder;
use Oneup\ContaoFormBundle\Service\FormDataNormalizer;
use Symfony\Component\Form\Flow\FormFlowInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

#[AsContentElement(category: 'includes')]
class OneupForm extends AbstractContentElementController
{
    public function __construct(
        private readonly FormBuilder $formBuilder,
        private readonly FormDataNormalizer $dataNormalizer,
        private readonly EventDispatcherInterface $eventDispatcher,
    ) {
    }

    protected function getResponse(FragmentTemplate $template, ContentModel $model, Request $request): Response
    {
        $id = (int) $model->oneup_form;

        if (!$id) {
            return new Response('');
        }

        $formModel = FormModel::findById($id);

        if (null === $formModel) {
            return new Response('');
        }

        $form = $this->formBuilder->build($id);
        $form->handleRequest($request);

        if ($this->isCompleted($form)) {
            $response = $this->postSubmit($form, $formModel);

            if ($response instanceof Response) {
                return $response;
            }
        } elseif ($form instanceof FormFlowInterface) {
            $form = $form->getStepForm();
        }

        $template->set('form', $form->createView());

        return $template->getResponse();
    }

    private function isCompleted(FormInterface $form): bool
    {
        if (!$form->isSubmitted() || !$form->isValid()) {
            return false;
        }

        return !$form instanceof FormFlowInterface || $form->isFinished();
    }

    private function postSubmit(FormInterface $form, FormModel $formModel): ?Response
    {
        $event = new PostSubmitEvent($form, $formModel, $this->dataNormalizer->normalize($form));

        $this->eventDispatcher->dispatch($event);

        return $event->response;
    }
}
