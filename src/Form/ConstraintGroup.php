<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form;

enum ConstraintGroup: string
{
    case Basic = 'basic';
    case String = 'string';
    case Comparison = 'comparison';
    case Number = 'number';
    case Date = 'date';
    case Choice = 'choice';
    case File = 'file';
}
