<?php

namespace Rusi\Jiminny\Test;

use Rusi\Jiminny\Result;
use PHPUnit\Framework\TestCase;

final class ResultTest extends TestCase
{
    private const USER = [[1.0, 2.0]];
    private const CUSTOMER = [[3.0, 4.0]];
    private const USER_MONOLOGUE = 5.0;
    private const CUSTOMER_MONOLOGUE = 6.0;
    private const USER_TALK_PERCENTAGE = 50.0;

    public function testJsonSerialize(): void
    {
        $result = new Result(self::USER, self::CUSTOMER);
        $result->longestUserMonologue = self::USER_MONOLOGUE;
        $result->longestCustomerMonologue = self::CUSTOMER_MONOLOGUE;
        $result->userTalkPercentage = self::USER_TALK_PERCENTAGE;

        self::assertSame([
            'longest_user_monologue' => self::USER_MONOLOGUE,
            'longest_customer_monologue' => self::CUSTOMER_MONOLOGUE,
            'user_talk_percentage' => self::USER_TALK_PERCENTAGE,
            'user' => [[1.0, 2.0]],
            'customer' => [[3.0, 4.0]],
        ], $result->jsonSerialize());
    }
}
