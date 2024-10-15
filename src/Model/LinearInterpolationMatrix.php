<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Model;

use PragmaGoTech\Interview\Exception\AppDomainException;

final class LinearInterpolationMatrix
{
    private array $matrix = [];

    public function __construct(
        array $matrix,
    ) {
        $this->setMatrix($matrix);
    }

    public static function createFrom(array $matrix): self
    {
        return new self($matrix);
    }

    public function getTermMatrix(int $term): ?array
    {
        return $this->matrix[$term] ?? null;
    }

    private function setMatrix(array $matrix): void
    {
        foreach ($matrix as $term => $subMatrix) {
            if (!in_array($term, LoanProposalTerm::getAllowedTerms(), true)) {
                throw new AppDomainException('Invalid matrix term');
            }

            if (!is_array($subMatrix) || empty($subMatrix)) {
                throw new AppDomainException('Invalid matrix configuration');
            }

            foreach ($subMatrix as $amount => $fee) {
                if (!is_numeric($amount)
                    || $amount < LoanProposalAmount::MIN_LOAN_PROPOSAL_AMOUNT
                    || $amount > LoanProposalAmount::MAX_LOAN_PROPOSAL_AMOUNT
                    || !is_numeric($fee)
                ) {
                    throw new AppDomainException('Invalid matrix configuration');
                }
            }
        }

        $this->matrix = $matrix;
    }
}