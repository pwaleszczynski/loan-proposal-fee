<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Strategy;

use PragmaGoTech\Interview\Model\LinearInterpolationMatrix;
use PragmaGoTech\Interview\Model\LoanProposal;
use RuntimeException;

class FeeCalculatorLinearInterpolationStrategy implements FeeCalculatorStrategy
{
    public function __construct(
        private readonly LinearInterpolationMatrix $matrix,
    ) {
    }

    public function calculate(LoanProposal $loanProposal): float
    {
        $termMatrix = $this->matrix->getTermMatrix($loanProposal->term()->getTerm());

        if (!$termMatrix) {
            throw new RuntimeException('Can not find correct term matrix.');
        }

        $amount = $loanProposal->amount()->getAmount();
        $lowerMatrixKey = $this->findLowerMatrixKey($termMatrix, $amount);

        if ($lowerMatrixKey === (int) $amount) {
            return (float) $termMatrix[$lowerMatrixKey];
        }

        $upperMatrixKey = $this->findUpperMatrixKey($termMatrix, $amount);

        if ($upperMatrixKey === (int) $amount) {
            return (float) $termMatrix[$upperMatrixKey];
        }

        $factor = ($amount - $lowerMatrixKey) / ($upperMatrixKey - $lowerMatrixKey);
        $fee = $termMatrix[$lowerMatrixKey] * (1 - $factor) + $termMatrix[$upperMatrixKey] * $factor;

        return (float) $fee;
    }

    private function findLowerMatrixKey(array $matrix, float $amount): int
    {
        $keys = array_filter(
            array_keys($matrix),
            fn (int $key) => $key < $amount,
        );

        if (count($keys) === 0) {
            return (int) $amount;
        }

        return max($keys);
    }

    private function findUpperMatrixKey(array $matrix, float $amount): int
    {
        $keys = array_filter(
            array_keys($matrix),
            fn (int $key) => $key > $amount,
        );

        if (count($keys) === 0) {
            return (int) $amount;
        }

        return min($keys);
    }
}
