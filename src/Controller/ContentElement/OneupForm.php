<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Controller\ContentElement;

use Contao\ContentModel;
use Contao\CoreBundle\Controller\ContentElement\AbstractContentElementController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsContentElement;
use Contao\CoreBundle\Twig\FragmentTemplate;
use Oneup\ContaoFormBundle\Service\FormBuilder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[AsContentElement(category: 'includes')]
class OneupForm extends AbstractContentElementController
{
    public function __construct(
        private readonly FormBuilder $formBuilder,
    ) {
    }

    protected function getResponse(FragmentTemplate $template, ContentModel $model, Request $request): Response
    {
        $id = (int) $model->oneup_form;

        if (!$id) {
            return new Response('');
        }

        $form = $this->formBuilder->build($id);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            exit('yeah baby yeah!');
        }

        $template->set('form', $form->createView());

        return $template->getResponse();
    }
}
