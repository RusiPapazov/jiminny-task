<?php

namespace Rusi\Jiminny\Test;

use Prophecy\Argument;
use Prophecy\PhpUnit\ProphecyTrait;
use Rusi\Jiminny\Analysis\AnalysisVisitorInterface;
use Rusi\Jiminny\App;
use PHPUnit\Framework\TestCase;
use Rusi\Jiminny\DataParser\DataParserInterface;
use Rusi\Jiminny\DataReader\DataReaderInterface;
use Rusi\Jiminny\Result;

/**
 * @covers \Rusi\Jiminny\App
 */
final class AppTest extends TestCase
{
    private const USER_SOURCE = 'user_source';
    private const USER_RAW_DATA = 'user_data';
    private const USER_PARSED_DATA = [[1.0, 2.0]];
    private const CUSTOMER_SOURCE = 'customer_source';
    private const CUSTOMER_RAW_DATA = 'customer_data';
    private const CUSTOMER_PARSED_DATA = [[3.0, 4.0]];

    use ProphecyTrait;

    public function testExecute(): void
    {
        $dataParser = $this->prophesize(DataParserInterface::class);
        $dataParser->parse(self::USER_RAW_DATA)->willReturn(self::USER_PARSED_DATA);
        $dataParser->parse(self::CUSTOMER_RAW_DATA)->willReturn(self::CUSTOMER_PARSED_DATA);
        /** @var DataParserInterface $revealedDataParser */
        $revealedDataParser = $dataParser->reveal();

        $dataReader = $this->prophesize(DataReaderInterface::class);
        $dataReader->read(self::USER_SOURCE)->willReturn(self::USER_RAW_DATA);
        $dataReader->read(self::CUSTOMER_SOURCE)->willReturn(self::CUSTOMER_RAW_DATA);
        /** @var DataReaderInterface $revealedDataReader */
        $revealedDataReader = $dataReader->reveal();

        $analysisVisitor = $this->prophesize(AnalysisVisitorInterface::class);
        $analysisVisitor->visit(Argument::type(Result::class))->shouldBeCalledOnce();
        /** @var AnalysisVisitorInterface $revealedAnalysisVisitor */
        $revealedAnalysisVisitor = $analysisVisitor->reveal();

        $app = new App($revealedDataParser, $revealedDataReader, [$revealedAnalysisVisitor]);

        $result = $app->execute(self::USER_SOURCE, self::CUSTOMER_SOURCE);

        $expected = new Result(self::USER_PARSED_DATA, self::CUSTOMER_PARSED_DATA);

        self::assertEquals($expected, $result);
    }
}
