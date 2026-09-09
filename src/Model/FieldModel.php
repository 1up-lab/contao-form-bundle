<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Model;

use Contao\Model;
use Contao\Model\Collection;

/**
 * @property int $id
 * @property string $name
 * @property string $type
 * @property string $alias
 * @property string $label
 * @property bool $html5
 * @property string $defaultProtocol
 * @property bool $required
 * @property bool $labelHtml
 * @property string $help
 * @property bool $helpHtml
 * @property bool $trim
 * @property string $placeholder
 *
 * @method static Collection<FieldModel>|null findBy($col, $val, array $opt = array())
 */
class FieldModel extends Model
{
    protected static $strTable = 'tl_oneup_form_field';
}
