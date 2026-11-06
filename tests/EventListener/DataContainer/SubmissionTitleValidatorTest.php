<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Tests\EventListener\DataContainer;

use Oneup\ContaoFormBundle\EventListener\DataContainer\SubmissionTitleValidator;
use Oneup\ContaoFormBundle\ExpressionLanguage\SubmissionTitleLanguage;
use PHPUnit\Framework\TestCase;
use Symfony\Contracts\Translation\TranslatorInterface;

class SubmissionTitleValidatorTest extends TestCase
{
    /**
     * @dataProvider validTitleProvider
     */
    public function testAcceptsValidTitles(string $title): void
    {
        self::assertSame($title, $this->createValidator()($title));
    }

    public static function validTitleProvider(): iterable
    {
        yield 'empty' => [''];
        yield 'fields' => ['data["name"] ~ " " ~ data["e-mail"]'];
        yield 'property access' => ['data.name ~ " " ~ data["e-mail"]'];
        yield 'condition' => ['(data["company"] ? data["company"] ~ " – " : "") ~ data["name"]'];
        yield 'comparison' => ['data.age < 18 ? "minor" : "adult"'];
    }

    /**
     * @dataProvider invalidTitleProvider
     */
    public function testRejectsInvalidTitles(string $title, string $message): void
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage($message);

        $this->createValidator()($title);
    }

    public static function invalidTitleProvider(): iterable
    {
        yield 'field without data' => ['name', 'Variable "name" is not valid'];
        yield 'unknown function' => ['upper(data["name"])', 'The function "upper" does not exist'];
        yield 'syntax error' => ['data["name"] ~', 'Unexpected token "end of expression"'];
        yield 'simple token' => ['##name##', 'Unexpected character "#"'];
    }

    private function createValidator(): SubmissionTitleValidator
    {
        $translator = $this->createMock(TranslatorInterface::class);
        $translator
            ->method('trans')
            ->willReturnCallback(static fn (string $id, array $parameters): string => $id . ': ' . implode(' ', $parameters))
        ;

        return new SubmissionTitleValidator(new SubmissionTitleLanguage(), $translator);
    }
}
