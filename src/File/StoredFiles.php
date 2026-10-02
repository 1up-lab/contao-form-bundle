<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\File;

use Symfony\Component\HttpFoundation\File\UploadedFile;

final class StoredFiles
{
    /**
     * @var \WeakMap<UploadedFile, StoredFile>
     */
    private \WeakMap $files;

    public function __construct()
    {
        $this->files = new \WeakMap();
    }

    public function add(UploadedFile $upload, StoredFile $file): void
    {
        $this->files[$upload] = $file;
    }

    public function get(UploadedFile $upload): ?StoredFile
    {
        return $this->files[$upload] ?? null;
    }

    /**
     * @return list<StoredFile>
     */
    public function getAttachments(): array
    {
        $attachments = [];

        foreach ($this->files as $file) {
            if ($file->attachToEmail) {
                $attachments[] = $file;
            }
        }

        return $attachments;
    }
}
