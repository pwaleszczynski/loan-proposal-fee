<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Model;

/**
 * A cut down version of a loan application containing
 * only the required properties for this test.
 */
class LoanProposal
{
    public function __construct(
        private readonly LoanProposalTerm $term,
        private readonly LoanProposalAmount $amount,
    ) {
    }

    /**
     * Term (loan duration) for this loan application
     * in number of months.
     */
    public function term(): LoanProposalTerm
    {
        return $this->term;
    }

    /**
     * Amount requested for this loan application.
     */
    public function amount(): LoanProposalAmount
    {
        return $this->amount;
    }
}
