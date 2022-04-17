<?php
namespace Rusi\Jiminny;

use JsonSerializable;

final class Result implements JsonSerializable
{
    /** @var float[][] */
    public array $user;
    /** @var float[][] */
    public array $customer;
    public float $longestUserMonologue;
    public float $longestCustomerMonologue;
    public float $userTalkPercentage;

    /**
     * @param float[][] $user
     * @param float[][] $customer
     */
    public function __construct(array $user, array $customer)
    {
        $this->user = $user;
        $this->customer = $customer;
    }

    /** @return array<string, float|float[][]> */
    public function jsonSerialize(): array
    {
        return [
            'longest_user_monologue' => $this->longestUserMonologue,
            'longest_customer_monologue' => $this->longestCustomerMonologue,
            'user_talk_percentage' => $this->userTalkPercentage,
            'user' => $this->user,
            'customer' => $this->customer,
        ];
    }
}