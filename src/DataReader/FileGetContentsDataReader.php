<?php

namespace Rusi\Jiminny\DataReader;

final class FileGetContentsDataReader implements DataReaderInterface
{
    public function read(string $source): string
    {
        return (string) file_get_contents($source);
    }
}