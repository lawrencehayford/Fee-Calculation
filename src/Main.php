<?php

require __DIR__.'/../vendor/autoload.php';

use Lendable\Fee\Interpolation\Model\LoanApplication;
use Lendable\Fee\Interpolation\Service\Fee\FeeCalculator;

$calculator = new FeeCalculator();

/** set the terms and loan amount from parameters */
list($key, $amount) = explode('=', $argv[1]);
list($key, $term) = explode('=', $argv[2]);

$application = new LoanApplication($term, $amount);
$fee = $calculator->calculate($application);

echo '£'.$amount.' : '.'£'.$fee. PHP_EOL;

