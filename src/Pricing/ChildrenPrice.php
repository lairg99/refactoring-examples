<?php

namespace App\Pricing;

use App\Movie;

class ChildrenPrice extends Price
{
    public function getPriceCode(): int {
        return Movie::CHILDREN;
    }

    public function getCharge(int $daysRented): float {
        $amount = 1.5;

        if ($daysRented > 3)
            $amount += ($daysRented - 3) * 1.5;

        return $amount;
    }
}
