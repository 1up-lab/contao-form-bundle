<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form\Field;

use Oneup\ContaoFormBundle\Attribute\AsField;
use Oneup\ContaoFormBundle\Form\AbstractField;
use Oneup\ContaoFormBundle\Form\FieldInterface;
use Oneup\ContaoFormBundle\Model\FieldModel;
use Symfony\Component\Form\Extension\Core\Type\UrlType;

#[AsField('url', UrlType::class)]
class Url extends AbstractField implements FieldInterface
{
    public function resolveOptions(FieldModel $model): array
    {
        $options = [
            ...parent::resolveOptions($model),
            'trim' => $model->trim,
            'default_protocol' => $model->defaultProtocol,
        ];

        if ($model->placeholder) {
            $options['attr']['placeholder'] = $model->placeholder;
        }

        return $options;
    }
}
