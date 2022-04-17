<?php
namespace Rusi\Jiminny\DataParser;

use RuntimeException;

interface DataParserInterface
{
    /**
     * @return array<float[]> tuples of [timeStart, timeEnd] of speech.
     * @throws RuntimeException if data is invalid or malformed.
     */
    public function parse(string $data): array;
}