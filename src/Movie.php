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
        match ($priceStrategy) {
            RegularPrice::class => $this->price = new RegularPrice,
            ChildrenPrice::class => $this->price = new ChildrenPrice,
            NewReleasePrice::class => $this->price = new NewReleasePrice,
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
