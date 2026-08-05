<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form\Field;

use Oneup\ContaoFormBundle\Attribute\AsField;
use Oneup\ContaoFormBundle\Form\AbstractField;
use Oneup\ContaoFormBundle\Form\FormFieldInterface;
use Symfony\Component\Form\Extension\Core\Type\UrlType;

#[AsField('url', UrlType::class)]
class Url extends AbstractField implements FormFieldInterface
{
    public function resolveOptions(array $row): array
    {
        return [
            'default_protocol' => $row['defaultProtocol'],
        ];
    }
}
