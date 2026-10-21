<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Model;

use Contao\Model;

/**
 * @property int $id
 * @property int $pid
 * @property int $tstamp
 * @property string $data
 */
class SubmissionModel extends Model
{
    protected static $strTable = 'tl_oneup_form_submission';
}
