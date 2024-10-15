<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Model;

use PragmaGoTech\Interview\Exception\AppDomainException;

class LoanProposalAmount
{
    public const MIN_LOAN_PROPOSAL_AMOUNT = 1000;
    public const MAX_LOAN_PROPOSAL_AMOUNT = 20000;

    private float $amount;

    public function __construct(float $amount)
    {
        if ($amount < self::MIN_LOAN_PROPOSAL_AMOUNT || $amount > self::MAX_LOAN_PROPOSAL_AMOUNT) {
            throw new AppDomainException('Invalid loan proposal amount');
        }

        $this->amount = $amount;
    }

    public static function createFrom(float $amount): self
    {
        return new self($amount);
    }

    public function getAmount(): float
    {
        return $this->amount;
    }
}
