<?php

namespace Lendable\Fee\Interpolation\Traits;

trait Messages
{
    /**
     * Contains constant messages
     * @var array
     */
    private  $messages = [
        'invalid_amount' => 'Invalid amount. Amount should be between £1,000 and £20,000',
        'invalid_term' => 'Invalid term.The term can be either 12 or 24 (number of months)',
        'not_multiples_of_five' => 'The Sum of (fee + loanAmount) should be multiples of 5',
    ];

    /**
     * Get error messages with error key
     * @param $key
     * @return string
     */
    protected function getErrorMessage($key) :string
    {
        return $this->messages[$key];
    }

}