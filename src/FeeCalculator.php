<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview;

use PragmaGoTech\Interview\Model\LoanProposal;

interface FeeCalculator
{
    public function calculate(LoanProposal $application): float;
}
