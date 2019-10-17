<?php

namespace Lendable\Fee\Interpolation\Tests\Model;

use Lendable\Fee\Interpolation\Tests\TestCase;
use Lendable\Fee\Interpolation\Model\LoanApplication;

class LoanApplicationTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_set_amount()
    {
        $application = new LoanApplication($this->getTerm(), $this->getAmount());
        $this->assertNotEmpty($application->getAmount());
        $this->assertIsFloat($this->getAmount(), $application->getAmount());
        $this->assertGreaterThan(0, $application->getAmount());
    }

    /**
     * @test
     */
    public function it_can_set_term()
    {
        $application = new LoanApplication($this->getTerm(), $this->getAmount());
        $this->assertNotEmpty($application->getTerm());
        $this->assertIsInt($this->getTerm(), $application->getTerm());
        $this->assertGreaterThan(0, $application->getTerm());
    }
}
