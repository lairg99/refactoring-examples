<?php

namespace App\Rental\Pricing;

abstract class Price
{
    public abstract function getPriceCode();

    public abstract function getCharge(int $daysRented): float;

    public function getFrequentRenterPoints(int $daysRented): int {
        return 1;
    }
}
