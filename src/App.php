<?php

namespace Rusi\Jiminny;

use Rusi\Jiminny\Analysis\AnalysisVisitorInterface;
use Rusi\Jiminny\DataParser\DataParserInterface;
use Rusi\Jiminny\DataReader\DataReaderInterface;

final class App
{
    private DataParserInterface $parser;
    private DataReaderInterface $dataReader;
    /** @var iterable<AnalysisVisitorInterface> */
    private iterable $analysisVisitors;

    /** @param iterable<AnalysisVisitorInterface> $analysisVisitors */
    public function __construct(
        DataParserInterface $parser,
        DataReaderInterface $dataReader,
        iterable $analysisVisitors
    ) {
        $this->parser = $parser;
        $this->dataReader = $dataReader;
        $this->analysisVisitors = $analysisVisitors;
    }

    public function execute(string $userSource, string $customerSource): Result
    {
        $result = new Result($this->parse($userSource), $this->parse($customerSource));

        foreach ($this->analysisVisitors as $visitor) {
            $visitor->visit($result);
        }

        return $result;
    }

    /** @return float[][] */
    private function parse(string $source): array
    {
        return $this->parser->parse($this->dataReader->read($source));
    }
}
