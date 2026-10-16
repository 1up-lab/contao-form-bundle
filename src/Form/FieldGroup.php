<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form;

enum FieldGroup: string
{
    case Texts = 'texts';
    case Buttons = 'buttons';
    case Choices = 'choices';
    case Dates = 'dates';
    case Moneys = 'moneys';
    case Numbers = 'numbers';
    case Others = 'others';
    case Steps = 'steps';
}
