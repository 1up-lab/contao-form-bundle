<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Model;

use Contao\Model;

/**
 * @property int $id
 * @property bool $isMultistep
 * @property string $jumpTo
 * @property bool $storeSubmissions
 * @property string $submissionExpression
 *
 * @method static FormModel|null findById($id, array $opt = array())
 */
class FormModel extends Model
{
    protected static $strTable = 'tl_oneup_form';
}
