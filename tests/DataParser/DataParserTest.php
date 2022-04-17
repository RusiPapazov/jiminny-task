<?php

namespace Rusi\Jiminny\Test\DataParser;

use PHPUnit\Framework\TestCase;
use RuntimeException;
use Rusi\Jiminny\DataParser\DataParser;

/**
 * @covers \Rusi\Jiminny\DataParser\DataParser
 */
final class DataParserTest extends TestCase
{
    private const EXPECTED = [[0.0, 1.84], [4.48, 26.928], [29.184, 29.36], [31.744, 56.624]];

    private DataParser $parser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->parser = new DataParser();
    }

    public function testParse(): void
    {
        $data = file_get_contents(__DIR__.'/../fixtures/customer-channel');
        $parsed = $this->parser->parse($data);

        self::assertSame(self::EXPECTED, $parsed);
    }

    public function testNegativeSpeeches(): void
    {
        $data = file_get_contents(__DIR__.'/../fixtures/negative-spaces');

        $parsed = $this->parser->parse($data);
        self::assertSame([[0.0, 1195.18]], $parsed);
    }

    public function testException(): void
    {
        $this->expectException(RuntimeException::class);
        $this->parser->parse('invalid data');
    }
}