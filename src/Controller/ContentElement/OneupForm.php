<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Controller\ContentElement;

use Contao\ContentModel;
use Contao\CoreBundle\Controller\ContentElement\AbstractContentElementController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsContentElement;
use Contao\CoreBundle\Twig\FragmentTemplate;
use Oneup\ContaoFormBundle\Event\PostSubmitEvent;
use Oneup\ContaoFormBundle\Form\Builder\FormBuilder;
use Oneup\ContaoFormBundle\Model\FormModel;
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
        private readonly EventDispatcherInterface $eventDispatcher,
    ) {
    }

    protected function getResponse(FragmentTemplate $template, ContentModel $model, Request $request): Response
    {
        /** @var int|null $id */
        $id = $model->oneup_form;

        $formModel = FormModel::findById($id);

        if (null === $formModel) {
            return new Response('');
        }

        $form = $this->formBuilder->build($formModel);
        $form->handleRequest($request);

        if ($this->isCompleted($form)) {
            $event = new PostSubmitEvent($form, $formModel);

            $this->eventDispatcher->dispatch($event);

            if ($event->response instanceof Response) {
                return $event->response;
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
}
