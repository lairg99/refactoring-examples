<?php

namespace App\Rental\Pricing;

use App\Rental\Movie;

class RegularPrice extends Price
{
    public function getPriceCode(): int {
        return Movie::REGULAR;
    }

    public function getCharge(int $daysRented): float {
        $amount = 2;

        if ($daysRented > 2)
            $amount += ($daysRented - 2) * 1.5;

        return $amount;
    }
}
