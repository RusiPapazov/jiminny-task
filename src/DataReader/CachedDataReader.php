<?php

namespace Rusi\Jiminny\DataReader;

use Psr\Cache\InvalidArgumentException;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

final class CachedDataReader implements DataReaderInterface
{
    private CacheInterface $cache;
    private DataReaderInterface $wrappedReader;
    private int $ttl;

    public function __construct(CacheInterface $cache, DataReaderInterface $wrappedReader, int $ttl)
    {
        $this->cache = $cache;
        $this->wrappedReader = $wrappedReader;
        $this->ttl = $ttl;
    }

    public function read(string $source): string
    {
        $cacheKey = str_replace(str_split(ItemInterface::RESERVED_CHARACTERS.' '), [], $source);

        return $this->cache->get($cacheKey, function (ItemInterface $item) use ($source): string {
            $item->expiresAfter($this->ttl);

            return $this->wrappedReader->read($source);
        });
    }
}