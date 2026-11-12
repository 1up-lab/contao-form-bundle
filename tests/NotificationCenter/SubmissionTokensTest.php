<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Tests\NotificationCenter;

use Oneup\ContaoFormBundle\NotificationCenter\SubmissionTokens;
use PHPUnit\Framework\TestCase;

class SubmissionTokensTest extends TestCase
{
    public function testCreatesTokensForNestedFields(): void
    {
        $values = [
            ['name' => 'step', 'label' => 'Step', 'children' => [
                ['name' => 'firstname', 'label' => 'First name', 'text' => 'Jane', 'links' => []],
                ['name' => 'address', 'label' => 'Address', 'children' => [
                    ['name' => 'city', 'label' => 'City', 'text' => '', 'links' => []],
                ]],
            ]],
            ['name' => 'remarks', 'label' => 'Remarks', 'text' => '<b>Hi</b>', 'links' => []],
        ];

        $tokens = (new SubmissionTokens())->create($values, []);

        self::assertSame(
            [
                'formlabel_firstname' => 'First name',
                'form_firstname' => 'Jane',
                'formlabel_city' => 'City',
                'form_city' => '',
                'formlabel_remarks' => 'Remarks',
                'form_remarks' => '<b>Hi</b>',
                'raw_data' => "First name: Jane\nCity: \nRemarks: <b>Hi</b>",
                'raw_data_filled' => "First name: Jane\nRemarks: <b>Hi</b>",
                'html_data' => 'First name: Jane<br>City: <br>Remarks: &lt;b&gt;Hi&lt;/b&gt;',
                'html_data_filled' => 'First name: Jane<br>Remarks: &lt;b&gt;Hi&lt;/b&gt;',
            ],
            $tokens,
        );
    }

    public function testCreatesFormConfigTokensForStringsAndIntegersOnly(): void
    {
        $formConfig = ['id' => 4, 'title' => 'Contact', 'isMultistep' => true, 'uploadFolder' => null];

        $tokens = (new SubmissionTokens())->create([], $formConfig);

        self::assertSame(4, $tokens['formconfig_id']);
        self::assertSame('Contact', $tokens['formconfig_title']);
        self::assertArrayNotHasKey('formconfig_isMultistep', $tokens);
        self::assertArrayNotHasKey('formconfig_uploadFolder', $tokens);
    }

    public function testUsesVouchersForUploadedFiles(): void
    {
        $values = [
            ['name' => 'attachment', 'label' => 'Attachment', 'text' => 'cv.pdf, photo.jpg', 'links' => []],
            ['name' => 'firstname', 'label' => 'First name', 'text' => 'Jane', 'links' => []],
        ];

        $tokens = (new SubmissionTokens())->create($values, [], ['attachment' => ['voucher-1', 'voucher-2']]);

        self::assertSame('voucher-1,voucher-2', $tokens['form_attachment']);
        self::assertSame('cv.pdf, photo.jpg', $tokens['file_attachment']);
        self::assertSame('Jane', $tokens['form_firstname']);
        self::assertArrayNotHasKey('file_firstname', $tokens);
        self::assertSame("Attachment: cv.pdf, photo.jpg\nFirst name: Jane", $tokens['raw_data']);
    }
}
