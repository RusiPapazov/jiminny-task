<?php

namespace Rusi\Jiminny\Test\Analysis;

use PHPUnit\Framework\TestCase;
use Rusi\Jiminny\Analysis\UserTalkPercentageVisitor;
use Rusi\Jiminny\Result;

/**
 * @covers \Rusi\Jiminny\Analysis\UserTalkPercentageVisitor
 */
final class UserTalkPercentageVisitorTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     *
     */
    public function testAnalyze(float $expected, array $user, array $customer): void
    {
        $result = new Result($user, $customer);
        $visitor = new UserTalkPercentageVisitor();
        $visitor->visit($result);

        self::assertSame($expected, $result->userTalkPercentage);
    }

    public function dataProvider(): array
    {
        return [
            [
                '$expected' => 0.0,
                '$user' => [],
                '$customer' => [[0.0, 1.0]],
            ],
            [
                '$expected' => 50.0,
                '$user' => [[0.0, 20.0]],
                '$customer' => [[20.0, 40.0]],
            ],
            [
                '$expected' => 33.0,
                '$user' => [[0.0, 33.0]],
                '$customer' => [[33.0, 66.0], [66.0, 100.0]],
            ],
        ];
    }
}
