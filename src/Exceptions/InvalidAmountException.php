<?php

namespace Lendable\Fee\Interpolation\Exceptions;

use Exception;
use Lendable\Fee\Interpolation\Contracts\LendableException;

class InvalidAmountException extends Exception implements LendableException
{
}
