<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Model;

use PragmaGoTech\Interview\Exception\AppDomainException;

final class LoanProposalTerm
{
    public const ONE_YEAR_TERM = 12;
    public const TWO_YEARS_TERM = 24;

    private ?int $term = null;

    public function __construct(int $term) {
        if (!in_array($term, self::getAllowedTerms(), true)) {
            throw new AppDomainException('Invalid loan proposal term');
        }

        $this->term = $term;
    }

    public function getTerm(): int
    {
        return $this->term;
    }

    public static function getAllowedTerms(): array
    {
        return [
            self::ONE_YEAR_TERM,
            self::TWO_YEARS_TERM,
        ];
    }
}
