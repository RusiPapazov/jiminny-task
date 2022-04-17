<?php

namespace Rusi\Jiminny\Analysis;

use Rusi\Jiminny\Result;

final class UserTalkPercentageVisitor implements AnalysisVisitorInterface
{
    public function visit(Result $result): void
    {
        $total = static fn(float $carry, array $times) => $carry + $times[1] - $times[0];
        $totalUser = array_reduce($result->user, $total, 0.0);
        $totalCustomer = array_reduce($result->customer, $total, 0.0);
        $result->userTalkPercentage = 100 * ($totalUser / ($totalUser + $totalCustomer));
    }
}