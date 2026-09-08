<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Service;

use Symfony\Component\Form\Flow\FormFlowInterface;
use Symfony\Component\Form\FormInterface;

class FormDataNormalizer
{
    public function normalize(FormInterface $form): array
    {
        $data = $form->getData();

        if (!\is_array($data)) {
            return [];
        }

        if (!$form instanceof FormFlowInterface) {
            return $data;
        }

        unset($data['_step']);

        $normalized = [];

        foreach ($data as $step => $values) {
            if (\is_array($values)) {
                $normalized = array_replace($normalized, $values);
            } else {
                $normalized[$step] = $values;
            }
        }

        return $normalized;
    }
}
