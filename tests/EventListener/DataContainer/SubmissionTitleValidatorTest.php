<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Tests\EventListener\DataContainer;

use Contao\CoreBundle\String\SimpleTokenParser;
use Oneup\ContaoFormBundle\EventListener\DataContainer\SubmissionTitleValidator;
use PHPUnit\Framework\TestCase;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;
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
        yield 'tokens' => ['##name## ##email##'];
        yield 'unknown token' => ['##emial##'];
        yield 'condition' => ['{if company != ""}##company## – {endif}##name##'];
    }

    /**
     * @dataProvider invalidTitleProvider
     */
    public function testRejectsInvalidTitles(string $title): void
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('ERR.invalidSubmissionTitle');

        $this->createValidator()($title);
    }

    public static function invalidTitleProvider(): iterable
    {
        yield 'unclosed condition' => ['{if company != ""}##company##'];
        yield 'invalid expression' => ['{if company ==}##company##{endif}'];
    }

    private function createValidator(): SubmissionTitleValidator
    {
        $translator = $this->createMock(TranslatorInterface::class);
        $translator
            ->method('trans')
            ->willReturnArgument(0)
        ;

        return new SubmissionTitleValidator(new SimpleTokenParser(new ExpressionLanguage()), $translator);
    }
}
