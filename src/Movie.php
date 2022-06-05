<?php

namespace App;

use App\Pricing\ChildrenPrice;
use App\Pricing\NewReleasePrice;
use App\Pricing\Price;
use App\Pricing\RegularPrice;
use InvalidArgumentException;

class Movie
{
    private Price $price;

    public function __construct(
        private readonly string $title,
        string $priceStrategy
    ) {
        $this->setPriceByStrategy($priceStrategy);
    }

    public function setPriceByStrategy(string $priceStrategy): void {
        if (!class_exists($priceStrategy)) {
            throw new InvalidArgumentException("$priceStrategy is not defined");
        }

        if (!(new $priceStrategy instanceof Price)) {
            throw new InvalidArgumentException("$priceStrategy must extend from price");
        }

        $this->price = new $priceStrategy;
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
