<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use PragmaGoTech\Interview\Model\LoanProposal;
use PragmaGoTech\Interview\Model\LoanProposalAmount;
use PragmaGoTech\Interview\Model\LoanProposalTerm;
use PragmaGoTech\Interview\Strategy\FeeCalculatorLinearInterpolationStrategyFactory;

final class FeeCalculatorLinearInterpolationStrategyTest extends TestCase
{
    /** @dataProvider dataProvider */
    public function testShouldCalculateCorrectFee(int $term, float $amount, float $fee): void
    {
        $strategy = FeeCalculatorLinearInterpolationStrategyFactory::create();

        $calculatedFee = $strategy->calculate(
            new LoanProposal(
                new LoanProposalTerm($term),
                LoanProposalAmount::createFrom($amount),
            )
        );

        self::assertSame($fee, $calculatedFee);
    }

    public function dataProvider(): array
    {
        return [
            [12, 1000, 50.0],
            [12, 10000, 200.0],
            [12, 19250, 385.0],
            [12, 20000, 400.0],
            [24, 1000, 70.0],
            [24, 10000, 400.0],
            [24, 11500, 460.0],
            [24, 20000, 800.0],
        ];
    }
}
