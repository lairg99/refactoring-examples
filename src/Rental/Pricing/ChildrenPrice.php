<?php

namespace App\Rental\Pricing;

use App\Rental\Movie;

class ChildrenPrice extends Price
{
    public function getCharge(int $daysRented): float {
        $amount = 1.5;

        if ($daysRented > 3)
            $amount += ($daysRented - 3) * 1.5;

        return $amount;
    }
}
