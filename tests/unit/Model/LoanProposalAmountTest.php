<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use PragmaGoTech\Interview\Exception\AppDomainException;
use PragmaGoTech\Interview\Model\LoanProposalAmount;

final class LoanProposalAmountTest extends TestCase
{
    /** @dataProvider invalidDataProvider */
    public function testShouldNotCreateInvalidAmount(float $amount): void
    {
        $this->expectException(AppDomainException::class);

        new LoanProposalAmount($amount);
    }

    public function invalidDataProvider(): array
    {
        return [
            [0],
            [100],
            [550.20],
            [999.99],
            [20000.01]
        ];
    }

    /** @dataProvider validDataProvider */
    public function testShouldCreateValidAmount(float $amount): void
    {
        $loanProposalAmount = new LoanProposalAmount($amount);

        self::assertSame($amount, $loanProposalAmount->getAmount());
    }

    public function validDataProvider(): array
    {
        return [
            [1000],
            [1000.01],
            [1550.20],
            [19999.99],
            [20000]
        ];
    }
}
