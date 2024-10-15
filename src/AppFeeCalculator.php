<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview;

use PragmaGoTech\Interview\Model\LoanProposal;
use PragmaGoTech\Interview\Strategy\FeeCalculatorStrategy;

class AppFeeCalculator implements FeeCalculator
{
    public function __construct(
        private FeeCalculatorStrategy $calculatorStrategy,
    )
    {
    }

    public function calculate(LoanProposal $application): float
    {
        return $this->calculatorStrategy->calculate($application);
    }
}
