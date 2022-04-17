<?php

namespace Rusi\Jiminny\Test\Analysis;

use PHPUnit\Framework\TestCase;
use Rusi\Jiminny\Analysis\LongestMonologueVisitor;
use Rusi\Jiminny\Result;

/**
 * @covers \Rusi\Jiminny\Analysis\LongestMonologueVisitor
 */
final class LongestMonologueVisitorTest extends TestCase
{
    public function testAnalyze(): void
    {
        $result = new Result(
            [[0.0, 10.0], [10.0, 30.0], [30.0, 40.0]],
            [[0.0, 1.0]],
        );
        $userMonologueVisitor = new LongestMonologueVisitor('user');
        $userMonologueVisitor->visit($result);
        $customerMonologueVisitor = new LongestMonologueVisitor('customer');
        $customerMonologueVisitor->visit($result);

        self::assertSame($result->longestUserMonologue, 20.0);
        self::assertSame($result->longestCustomerMonologue, 1.0);
    }
}
