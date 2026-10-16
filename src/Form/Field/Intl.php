<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Form\Field;

use Contao\StringUtil;
use Oneup\ContaoFormBundle\Attribute\AsField;
use Oneup\ContaoFormBundle\Form\AbstractField;
use Oneup\ContaoFormBundle\Form\FieldGroup;
use Oneup\ContaoFormBundle\Form\FieldInterface;
use Oneup\ContaoFormBundle\Model\FieldModel;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\CurrencyType;
use Symfony\Component\Form\Extension\Core\Type\LanguageType;
use Symfony\Component\Form\Extension\Core\Type\TimezoneType;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Exception\MissingResourceException;
use Symfony\Component\Intl\Languages;

#[AsField(name: 'country', formType: CountryType::class, group: FieldGroup::Choices)]
#[AsField(name: 'language', formType: LanguageType::class, group: FieldGroup::Choices)]
#[AsField(name: 'currency', formType: CurrencyType::class, group: FieldGroup::Moneys)]
#[AsField(name: 'timezone', formType: TimezoneType::class, group: FieldGroup::Dates)]
class Intl extends AbstractField implements FieldInterface
{
    public function resolveOptions(FieldModel $model): array
    {
        $options = parent::resolveOptions($model);

        if ($model->placeholder) {
            $options['placeholder'] = $model->placeholder;
        }

        $options['expanded'] = $model->expanded;
        $options['multiple'] = $model->multiple;

        if (\in_array($model->type, ['country', 'language'], true)) {
            $options['alpha3'] = $model->alpha3;
        }

        $preferred = $this->getPreferredChoices($model);

        if ($preferred) {
            $options['preferred_choices'] = $preferred;
            $options['duplicate_preferred_choices'] = $model->duplicatePreferredChoices;
        }

        return $options;
    }

    private function getPreferredChoices(FieldModel $model): array
    {
        $choices = [];
        $preferredChoices = (array) StringUtil::deserialize($model->preferredChoices, true);

        $alpha3 = match ($model->alpha3 ? $model->type : null) {
            'country' => Countries::getAlpha3Code(...),
            'language' => Languages::getAlpha3Code(...),
            default => null,
        };

        foreach ($preferredChoices as $choice) {
            if (!\is_string($choice) || '' === $choice) {
                continue;
            }

            if (null === $alpha3) {
                $choices[] = $choice;

                continue;
            }

            try {
                $choices[] = $alpha3($choice);
            } catch (MissingResourceException) {
                continue;
            }
        }

        return $choices;
    }
}
