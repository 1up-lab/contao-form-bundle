<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Model;

use Contao\Model;
use Contao\Model\Collection;

/**
 * @property int $id
 * @property int $pid
 * @property string $ptable
 * @property int $tstamp
 * @property int $sorting
 * @property string $name
 * @property string $alias
 * @property string $type
 * @property string $placeholder
 * @property string $label
 * @property bool $labelHtml
 * @property string $help
 * @property bool $helpHtml
 * @property bool $trim
 * @property bool $required
 * @property string $defaultProtocol
 * @property bool $html5
 * @property bool $published
 *
 * @method static Collection<FieldModel>|null findBy($col, $val, array $opt = array())
 */
class FieldModel extends Model
{
    protected static $strTable = 'tl_oneup_form_field';
}
