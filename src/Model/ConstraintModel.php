<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Model;

use Contao\Model;
use Contao\Model\Collection;

/**
 * @property int $id
 * @property string $type
 * @property string $message
 *
 * @method static ConstraintModel|null findById($id, array $opt = array())
 * @method static Collection<ConstraintModel>|null findBy($col, $val, array $opt = array())
 */
class ConstraintModel extends Model
{
    protected static $strTable = 'tl_oneup_form_constraint';
}
