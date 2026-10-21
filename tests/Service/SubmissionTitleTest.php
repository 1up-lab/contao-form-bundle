<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Tests\Service;

use Contao\CoreBundle\String\SimpleTokenParser;
use Oneup\ContaoFormBundle\Service\SubmissionTitle;
use PHPUnit\Framework\TestCase;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

class SubmissionTitleTest extends TestCase
{
    private const VALUES = [
        [
            'name' => 'personal-data',
            'label' => 'Personal data',
            'children' => [
                ['name' => 'name', 'label' => 'Name', 'text' => 'Jane Doe', 'links' => []],
                [
                    'name' => 'contact',
                    'label' => 'Contact',
                    'children' => [
                        ['name' => 'email', 'label' => 'Email', 'text' => 'jane@example.com', 'links' => []],
                    ],
                ],
            ],
        ],
        ['name' => 'company', 'label' => 'Company', 'text' => '', 'links' => []],
    ];

    /**
     * @dataProvider titleProvider
     */
    public function testGeneratesTheTitleFromTheSubmittedValues(string $title, string $expected): void
    {
        self::assertSame($expected, $this->createSubmissionTitle()->generate($title, self::VALUES));
    }

    public static function titleProvider(): iterable
    {
        yield 'nested fields' => ['##name## ##email##', 'Jane Doe jane@example.com'];
        yield 'missing field' => ['##name## ##phone##', 'Jane Doe'];
        yield 'condition' => ['{if company != ""}##company## – {endif}##name##', 'Jane Doe'];
        yield 'invalid condition' => ['{if company ==}##company##{endif}', ''];
        yield 'empty' => ['', ''];
    }

    public function testEscapesTheSubmittedValues(): void
    {
        $values = [['name' => 'name', 'label' => 'Name', 'text' => '<script>alert(1)</script>', 'links' => []]];

        self::assertSame(
            '&lt;script&gt;alert(1)&lt;/script&gt;',
            $this->createSubmissionTitle()->generate('##name##', $values),
        );
    }

    private function createSubmissionTitle(): SubmissionTitle
    {
        return new SubmissionTitle(new SimpleTokenParser(new ExpressionLanguage()));
    }
}
