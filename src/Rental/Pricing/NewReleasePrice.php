<?php

namespace App\Rental\Pricing;

use App\Rental\Movie;

class NewReleasePrice extends Price
{
    public function getCharge(int $daysRented): float {
        return $daysRented * 3;
    }

    public function getFrequentRenterPoints(int $daysRented): int {
        return $daysRented > 1 ? 2 : 1;
    }
}
