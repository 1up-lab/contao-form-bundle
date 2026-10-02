<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Model;

use Contao\Model;
use Contao\Model\Collection;

/**
 * @property int      $id
 * @property int      $pid
 * @property int      $tstamp
 * @property int      $sorting
 * @property string   $type
 * @property bool     $overwriteMessage
 * @property string   $message
 * @property string   $value
 * @property int|null $min
 * @property int|null $max
 * @property string   $pattern
 * @property bool     $matchPattern
 * @property bool     $requireTopLevelDomain
 * @property string   $maxSize
 * @property string   $extensions
 * @property int|null $minWidth
 * @property int|null $maxWidth
 * @property int|null $minHeight
 * @property int|null $maxHeight
 *
 * @method static ConstraintModel|null             findById($id, array $opt = [])
 * @method static Collection<ConstraintModel>|null findBy($col, $val, array $opt = [])
 */
class ConstraintModel extends Model
{
    protected static $strTable = 'tl_oneup_form_constraint';
}
