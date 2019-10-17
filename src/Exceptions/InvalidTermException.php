<?php

namespace Lendable\Fee\Interpolation\Exceptions;

use Exception;
use Lendable\Fee\Interpolation\Contracts\LendableException;

class InvalidTermException extends Exception implements LendableException
{
}
