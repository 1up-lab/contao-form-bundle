<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Model;

use Contao\Model;

/**
 * @property int $id
 * @property int $tstamp
 * @property string $name
 * @property bool $storeSubmissions
 * @property string $submissionExpression
 * @property int $jumpTo
 * @property bool $isMultistep
 *
 * @method static FormModel|null findById($id, array $opt = array())
 */
class FormModel extends Model
{
    protected static $strTable = 'tl_oneup_form';
}
