<?php

namespace App\Pricing;

use App\Movie;

class NewReleasePrice extends Price
{
    public function getPriceCode(): int {
        return Movie::NEW_RELEASE;
    }

    public function getCharge(int $daysRented): float {
        return $daysRented * 3;
    }

    public function getFrequentRenterPoints(int $daysRented): int {
        return $daysRented > 1 ? 2 : 1;
    }
}
