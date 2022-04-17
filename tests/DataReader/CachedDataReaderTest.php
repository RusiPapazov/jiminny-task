<?php

namespace Rusi\Jiminny\Test\DataReader;

use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Prophecy\PhpUnit\ProphecyTrait;
use Rusi\Jiminny\DataReader\CachedDataReader;
use Rusi\Jiminny\DataReader\DataReaderInterface;
use Symfony\Contracts\Cache\CacheInterface;

final class CachedDataReaderTest extends TestCase
{
    use ProphecyTrait;

    private const TTL = 1;
    private const CACHE_KEY = 'key';
    private const EXPECTED_RESULT = 'result';

    public function testRead(): void
    {
        $cache = $this->prophesize(CacheInterface::class);
        $cache->get(self::CACHE_KEY, Argument::any())
            ->shouldBeCalledOnce()
            ->willReturn(self::EXPECTED_RESULT);
        /** @var CacheInterface $revealedCache */
        $revealedCache = $cache->reveal();

        $wrappedReader = $this->prophesize(DataReaderInterface::class);
        $wrappedReader->read(self::CACHE_KEY)
            ->shouldNotBeCalled();
        /** @var DataReaderInterface $revealedWrappedReader */
        $revealedWrappedReader = $wrappedReader->reveal();

        $cachedReader = new CachedDataReader($revealedCache, $revealedWrappedReader, self::TTL);

        self::assertSame(self::EXPECTED_RESULT, $cachedReader->read(self::CACHE_KEY));
    }
}
