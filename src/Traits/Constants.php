<?php

namespace Lendable\Fee\Interpolation\Traits;

trait Constants
{
    /**
     * @var float $minimumAmount
     */
    protected $minimumAmount = 1000;

    /**
     * @var float $maximumAmount
     */
    protected $maximumAmount = 20000;

    /**
     * @var int $startTerm
     */
    protected $startTerm = 1;

    /**
     * @var array $termList
     */
    protected $termList = [12, 24];
}