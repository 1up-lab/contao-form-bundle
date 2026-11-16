<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\Tests\Service;

use Oneup\ContaoFormBundle\File\StoredFile;
use Oneup\ContaoFormBundle\File\StoredFiles;
use Oneup\ContaoFormBundle\Service\ValueFormatter;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Translation\Loader\ArrayLoader;
use Symfony\Component\Translation\Translator;

class ValueFormatterTest extends TestCase
{
    /**
     * @dataProvider valueProvider
     */
    public function testFormatsValuesAsText(mixed $value, string $expected): void
    {
        self::assertSame($expected, $this->createFormatter()->format($value, new StoredFiles()));
    }

    public static function valueProvider(): iterable
    {
        yield 'string' => ['Jane', 'Jane'];
        yield 'null' => [null, ''];
        yield 'checked' => [true, '1'];
        yield 'unchecked' => [false, ''];
        yield 'date' => [new \DateTimeImmutable('2026-10-21 14:30'), '2026-10-21 14:30'];
        yield 'list' => [['Course A', '', null, 'Course B'], 'Course A, Course B'];
        yield 'interval' => [new \DateInterval('P1Y2M'), '1 year, 2 months'];
        yield 'negative interval' => [(new \DateTimeImmutable('2026-01-02'))->diff(new \DateTimeImmutable('2026-01-01')), '-1 day'];
        yield 'empty interval' => [new \DateInterval('P0D'), ''];
        yield 'object' => [new \stdClass(), ''];
    }

    public function testFormatsUploadsAsThePathOfTheirStoredFile(): void
    {
        $stored = new UploadedFile(__FILE__, 'cv.pdf', test: true);
        $notStored = new UploadedFile(__FILE__, 'photo.jpg', test: true);

        $storedFiles = new StoredFiles();
        $storedFiles->add($stored, new StoredFile('cv.pdf', '/tmp/cv.pdf', 'files/uploads/cv.pdf'));

        self::assertSame(
            'files/uploads/cv.pdf, photo.jpg',
            $this->createFormatter()->format([$stored, $notStored], $storedFiles),
        );
    }

    private function createFormatter(): ValueFormatter
    {
        $translator = new Translator('en');
        $translator->addLoader('array', new ArrayLoader());
        $translator->addResource('array', [
            'interval.years' => '%count% year|%count% years',
            'interval.months' => '%count% month|%count% months',
            'interval.days' => '%count% day|%count% days',
        ], 'en', 'oneup_form_bundle');

        return new ValueFormatter($translator);
    }
}
