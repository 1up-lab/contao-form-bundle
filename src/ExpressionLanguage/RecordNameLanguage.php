<?php

declare(strict_types=1);

namespace Oneup\ContaoFormBundle\ExpressionLanguage;

use Psr\Cache\CacheItemPoolInterface;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

class RecordNameLanguage extends ExpressionLanguage
{
    public function __construct(?CacheItemPoolInterface $cache = null, array $providers = [])
    {
        parent::__construct($cache, $providers);
    }
}
