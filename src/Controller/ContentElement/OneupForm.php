<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Controller\ContentElement;

use Contao\ContentModel;
use Contao\CoreBundle\Controller\ContentElement\AbstractContentElementController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsContentElement;
use Contao\CoreBundle\Twig\FragmentTemplate;
use Doctrine\DBAL\Connection;
use Oneup\ContaoFormBundle\Event\PostSubmitEvent;
use Oneup\ContaoFormBundle\Service\FormBuilder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

#[AsContentElement(category: 'includes')]
class OneupForm extends AbstractContentElementController
{
    public function __construct(
        private readonly FormBuilder $formBuilder,
        private readonly Connection $database,
        private readonly EventDispatcherInterface $eventDispatcher,
    ) {
    }

    protected function getResponse(FragmentTemplate $template, ContentModel $model, Request $request): Response
    {
        $id = (int) $model->oneup_form;

        if (!$id) {
            return new Response('');
        }

        $formConfig = $this->database->createQueryBuilder()
            ->select('f.*')
            ->from('tl_oneup_form', 'f')
            ->where('f.id = :id')
            ->setParameter('id', $id)
            ->fetchAssociative()
        ;

        if (false === $formConfig) {
            return new Response('');
        }

        $form = $this->formBuilder->build($id);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->eventDispatcher->dispatch($event = new PostSubmitEvent($formConfig));

            if (($response = $event->getResponse()) instanceof Response) {
                return $response;
            }
        }

        $template->set('form', $form->createView());

        return $template->getResponse();
    }
}
