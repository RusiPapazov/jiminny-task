<?php

namespace Rusi\Jiminny\DataParser;

use RuntimeException;

final class DataParser implements DataParserInterface
{
    private const SILENCE_REGEXP = '/silence_(start|end):\s(\d+(\.\d+))?/';
    private const MATCHES_INDEX = 2;

    public function parse(string $data): array
    {
        $result = preg_match_all(self::SILENCE_REGEXP, $data, $matches);
        if ($result === 0 || $result === false) {
            throw new RuntimeException('Invalid data');
        }
        $times = $matches[self::MATCHES_INDEX];

        //Prepend 0.0, starting of the speech.
        array_unshift($times, 0.0);
        //Remove the last silence start, ignore it.
        array_pop($times);

        $floatTimes = array_map('floatval', $times);

        $tuples = array_chunk($floatTimes, 2);

        // Remove the negative or 0-length speeches.
        return array_values(
            array_filter($tuples, static fn (array $time) => $time[1] > $time[0]),
        );
    }
}
