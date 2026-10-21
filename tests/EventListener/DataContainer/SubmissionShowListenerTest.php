<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Tests\EventListener\DataContainer;

use Oneup\ContaoFormBundle\EventListener\DataContainer\SubmissionShowListener;
use PHPUnit\Framework\TestCase;

class SubmissionShowListenerTest extends TestCase
{
    public function testShowsEachFieldAsItsOwnRow(): void
    {
        $data = [
            'tl_oneup_form_submission' => [
                [
                    'Title <small>name</small>' => 'Jane Doe',
                ],
            ],
        ];

        $values = [
            [
                'name' => 'personal-data',
                'label' => 'Personal data',
                'children' => [
                    ['name' => 'firstname', 'label' => 'First name', 'text' => 'Jane', 'links' => []],
                    ['name' => 'remarks', 'label' => 'Remarks <i>optional</i>', 'text' => '', 'links' => []],
                ],
            ],
        ];

        $result = (new SubmissionShowListener())($data, ['data' => json_encode($values)]);

        self::assertSame(
            [
                'Title <small>name</small>' => 'Jane Doe',
                '<strong>Personal data</strong> <small>personal-data</small>' => '',
                'First name <small>firstname</small>' => 'Jane',
                'Remarks &lt;i&gt;optional&lt;/i&gt; <small>remarks</small>' => '–',
            ],
            $result['tl_oneup_form_submission'][0],
        );
    }
}
