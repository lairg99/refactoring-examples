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

    private string $title;

    private Price $price;

    public function __construct(string $_title, int $_priceCode) {
        $this->title = $_title;
        $this->setPriceCode($_priceCode);
    }

    public function setPriceCode(int $priceCode): void {
        switch ($priceCode) {
            case self::REGULAR:
                $this->price = new RegularPrice;
                break;
            case self::CHILDREN:
                $this->price = new ChildrenPrice;
                break;
            case self::NEW_RELEASE:
                $this->price = new NewReleasePrice;
                break;
            default:
                throw new InvalidArgumentException('Incorrect price code');
        }
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
