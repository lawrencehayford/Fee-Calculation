<?php

declare (strict_types = 1);

namespace Lendable\Fee\Interpolation\Service\Fee;

use Lendable\Fee\Interpolation\Traits\Messages;
use Lendable\Fee\Interpolation\Traits\Constants;
use Lendable\Fee\Interpolation\Model\LoanApplication;
use Lendable\Fee\Interpolation\Exceptions\InvalidTermException;
use Lendable\Fee\Interpolation\Contracts\FeeCalculatorInterface;
use Lendable\Fee\Interpolation\Exceptions\InvalidAmountException;

/**
 * Calculates fees for loan applications.
 */
class FeeCalculator implements FeeCalculatorInterface
{
    use Messages;
    use Constants;

    /**
     * Calculates the fee for a loan application.
     *
     * @param LoanApplication $application The loan application to
     * calculate for.
     *
     * @return float The calculated fee.
     * @throws InvalidAmountException
     * @throws InvalidTermException
     * @throws NotMultiplesOfFiveException
     */
    public function calculate(LoanApplication $application): float
    {
        $endTerm = $application->getTerm();
        $amount = $application->getAmount();

        if ($this->validate($endTerm, $amount)) {
            $interpolatedResult = $this->interpolate($this->startTerm, $endTerm, $amount);
            return $interpolatedResult;
        }
    }

    /**
     * Calculates the fee for a loan application.
     *
     * @param $startTerm
     * @param $endTerm
     * @param $loanAmt
     * @return float The calculated fee.
     */
    private function interpolate($startTerm, $endTerm, $loanAmt): float
    {
        $fee = round(($loanAmt - $startTerm) / ($endTerm - $startTerm), 0);
        if ($this->isMultiplesOfFive($fee, $loanAmt)) {
            return $fee;
        } else {
           return ($fee - ($fee % 5));
        }
    }

    /**
     * Checks if amount falls within minimum amount ie £1,000
     *
     * @param float $amount
     * @return bool ie true or false.
     */
    private function isValidAmount(float $amount) : bool
    {
        return (($amount >= $this->minimumAmount) && ($amount <= $this->maximumAmount)) ? true : false;
    }

    /**
     * Checks if term is either 12 or 24
     *
     * @param int $term
     * @return bool ie true or false.
     */
    private function isValidTerm(int $term) : bool
    {
        return (in_array($term, $this->termList)) ? true : false;
    }

    /**
     * Checks (fee + loan amount) is an exact multiple of 5
     *
     * @param float $fee
     * @param float $loanAmount
     * @return bool ie true or false.
     */
    private function isMultiplesOfFive (float $fee, float $loanAmount) : bool
    {
        return (($fee + $loanAmount) % 5 == 0) ? true: false;
    }

    /**
     * Validated both terms and amount
     *
     * @param int $term
     * @param float $amount
     * @return true
     * @throws InvalidAmountException
     * @throws InvalidTermException
     */
    private function validate(int $term, float $amount) :bool
    {
        if (!$this->isValidAmount($amount)) {
            throw new InvalidAmountException($this->getErrorMessage('invalid_amount'));
        }

        if (!$this->isValidTerm($term)) {
            throw new InvalidTermException($this->getErrorMessage('invalid_term'));
        }
        return true;
    }
}
