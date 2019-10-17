<?php

namespace Lendable\Fee\Interpolation\Tests\Service\Fee;

use Lendable\Fee\Interpolation\Tests\TestCase;
use Lendable\Fee\Interpolation\Model\LoanApplication;
use Lendable\Fee\Interpolation\Exceptions\InvalidTermException;
use Lendable\Fee\Interpolation\Exceptions\InvalidAmountException;

class FeeCalculatorTest extends TestCase
{
    /**
     * @test
     */
    public function it_calculates_fee()
    {
        $application = new LoanApplication($this->getTerm(), $this->getAmount());
        $expectedFee = (float) 40;
        $actualFee = $this->calculator->calculate($application);
        $this->assertNotEmpty($actualFee);
        $this->assertIsFloat($expectedFee, $actualFee);
        $this->assertGreaterThan(0, $actualFee);
    }

    /**
     * @test
     */
    public function it_requires_fee_to_be_less_than_loan_amount()
    {
        $application = new LoanApplication($this->getTerm(), $this->getAmount());
        $loanAmount = (float) $this->getAmount();
        $feeAmount = $this->calculator->calculate($application);
        $this->assertGreaterThan($feeAmount, $loanAmount);
    }

    /**
     * @test
     */
    public function it_throws_when_amount_is_less_than_1000()
    {
        $this->amount = 900;
        $application = new LoanApplication($this->getTerm(), $this->getAmount());

        $this->expectException(InvalidAmountException::class);
        $this->expectExceptionMessage('Invalid amount. Amount should be between £1,000 and £20,000');
        $this->calculator->calculate($application);
    }

    /**
     * @test
     */
    public function it_throws_when_amount_is_greater_than_20000()
    {
        $this->amount = 21000;
        $application = new LoanApplication($this->getTerm(), $this->getAmount());

        $this->expectException(InvalidAmountException::class);
        $this->expectExceptionMessage('Invalid amount. Amount should be between £1,000 and £20,000');
        $this->calculator->calculate($application);
    }

    /**
     * @test
     */
    public function it_throws_when_term_is_not_12()
    {
        $this->term = 13;
        $expectedMessage = 'Invalid term.The term can be either 12 or 24 (number of months)';
        $application = new LoanApplication($this->getTerm(), $this->getAmount());

        $this->expectException(InvalidTermException::class);
        $this->expectExceptionMessage($expectedMessage);
        $this->calculator->calculate($application);

        $this->expectException(InvalidTermException::class);
        $this->expectExceptionMessage($expectedMessage);
        $this->term = 12;
        $application = new LoanApplication($this->getTerm(), $this->getAmount());
        $this->calculator->calculate($application);
    }

    /**
     * @test
     */
    public function it_throws_when_term_is_not_24()
    {
        $this->term = 25;
        $expectedMessage = 'Invalid term.The term can be either 12 or 24 (number of months)';
        $application = new LoanApplication($this->getTerm(), $this->getAmount());

        $this->expectException(InvalidTermException::class);
        $this->expectExceptionMessage($expectedMessage);
        $this->calculator->calculate($application);
    }
}
