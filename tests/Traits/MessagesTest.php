<?php


namespace Lendable\Fee\Interpolation\Tests\Traits;

use Lendable\Fee\Interpolation\Tests\TestCase;
use Lendable\Fee\Interpolation\Traits\Messages;

class MessagesTest extends TestCase
{
    use Messages;
    /**
     * @test
     */
    public function it_can_get_error_messages()
    {
        $errorMessage = $this->getErrorMessage($this->errorKey);
        $expected = 'Invalid amount. Amount should be between £1,000 and £20,000';
        $this->assertNotEmpty($errorMessage);
        $this->assertIsString($errorMessage);
        $this->assertEquals($expected, $errorMessage);
    }
}