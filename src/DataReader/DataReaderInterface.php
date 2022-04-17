<?php

namespace Rusi\Jiminny\DataReader;

/**
 * Gets the source data.
 *
 * Returns the raw data as string, example:
 * [silencedetect @ 0x7fa7edd0c160] silence_start: 1.84
 * [silencedetect @ 0x7fa7edd0c160] silence_end: 4.48 | silence_duration: 2.64
 * [silencedetect @ 0x7fa7edd0c160] silence_start: 26.928
 */
interface DataReaderInterface
{
    public function read(string $source): string;
}