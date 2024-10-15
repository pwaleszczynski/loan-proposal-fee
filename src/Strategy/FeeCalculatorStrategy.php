<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Strategy;

use PragmaGoTech\Interview\Model\LoanProposal;

interface FeeCalculatorStrategy
{
    public function calculate(LoanProposal $loanProposal): float;
}
