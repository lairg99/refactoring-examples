<?php

namespace App;

use App\Pricing\ChildrenPrice;
use App\Pricing\NewReleasePrice;
use App\Pricing\Price;
use App\Pricing\RegularPrice;
use InvalidArgumentException;

class Movie
{
    const CHILDREN = 2;
    const REGULAR = 0;
    const NEW_RELEASE = 1;

    private Price $price;

    public function __construct(
        private readonly string $title,
        int $priceCode
    ) {
        $this->setPriceCode($priceCode);
    }

    public function setPriceCode(int $priceCode): void {
        match ($priceCode) {
            self::REGULAR => $this->price = new RegularPrice,
            self::CHILDREN => $this->price = new ChildrenPrice,
            self::NEW_RELEASE => $this->price = new NewReleasePrice,
            default => throw new InvalidArgumentException('Incorrect price code')
        };
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getFrequentRenterPoints(int $daysRented): int {
        return $this->price->getFrequentRenterPoints($daysRented);
    }

    public function getCharge(int $daysRented): float {
        return $this->price->getCharge($daysRented);
    }
}
