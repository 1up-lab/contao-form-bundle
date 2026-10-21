<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Model;

use Contao\Model;

/**
 * @property int $id
 * @property int $tstamp
 * @property string $name
 * @property bool $storeSubmissions
 * @property string $submissionTitle
 * @property int $jumpTo
 * @property bool $isMultistep
 * @property bool $sendViaEmail
 * @property string $mailerTransport
 * @property string $recipient
 * @property string $subject
 * @property string $emailTemplate
 *
 * @method static FormModel|null findById($id, array $opt = [])
 */
class FormModel extends Model
{
    protected static $strTable = 'tl_oneup_form';
}
