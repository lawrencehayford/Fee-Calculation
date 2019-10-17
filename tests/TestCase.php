<?php

namespace Lendable\Fee\Interpolation\Tests;

use Lendable\Fee\Interpolation\Service\Fee\FeeCalculator;
use PHPUnit\Framework\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * @var int
     */
    protected $term;

    /**
     * @var float
     */
    protected $amount;

    /**
     * @var FeeCalculator
     */
    protected $calculator;

    /**
     * @var string
     */
    protected $errorKey;

    protected function setUp(): void
    {
        parent::setUp();
        $this->amount = 1000;
        $this->term = 12;
        $this->errorKey = 'invalid_amount';
        $this->calculator = new FeeCalculator();
    }

    /**
     * @return int
     */
    protected function getTerm(): int
    {
        return $this->term;
    }

    /**
     * @return float
     */
    protected function getAmount(): float
    {
        return $this->amount;
    }
}
