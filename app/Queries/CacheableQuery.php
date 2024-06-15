<?php

namespace App\Queries;

use DateTimeInterface;
use Illuminate\Support\Facades\Cache;
use RuntimeException;

abstract class CacheableQuery
{
    public const CACHE_KEY = 'cacheable-query';
    public const CACHE_TTL = 60*24*365; // 1 year

    abstract protected function query(): array;

    public function handle(): array
    {
        return Cache::remember(
            $this->key(),
            $this->ttl(),
            fn () => $this->query()
        );
    }

    protected function key(): string
    {
        $key = static::CACHE_KEY;

        if ($key === 'cacheable-query') {
            throw new RuntimeException('Please define a CACHE_KEY constant in your query class');
        }

        return $key;
    }

    protected function ttl(): DateTimeInterface
    {
        return now()->addMinutes(static::CACHE_TTL);
    }
}
