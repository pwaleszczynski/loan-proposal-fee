<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use PragmaGoTech\Interview\Exception\AppDomainException;
use PragmaGoTech\Interview\Model\LoanProposalTerm;

final class LoanProposalTermTest extends TestCase
{
    public function testShouldNotCreateIncorrectTerm(): void
    {
        $this->expectException(AppDomainException::class);

        new LoanProposalTerm(9);
    }

    /** @dataProvider dataProvider */
    public function testShouldProvideCorrectTerm(int $term): void
    {
        $loanProposalTerm = new LoanProposalTerm($term);

        self::assertSame($term, $loanProposalTerm->getTerm());
    }

    public function dataProvider(): array
    {
        return [
            [12],
            [24],
        ];
    }
}
