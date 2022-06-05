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

    private string $_title;
    private int $_priceCode;

    private Price $_price;

    public function __construct(string $_title, int $_priceCode) {
        $this->_title = $_title;
        $this->setPriceCode($_priceCode);
    }

    public function getPriceCode(): int {
        return $this->_price->getPriceCode();
    }

    public function setPriceCode(int $priceCode): void {
        switch ($priceCode) {
            case self::REGULAR:
                $this->_price = new RegularPrice;
                break;
            case self::CHILDREN:
                $this->_price = new ChildrenPrice;
                break;
            case self::NEW_RELEASE:
                $this->_price = new NewReleasePrice;
                break;
            default:
                throw new InvalidArgumentException('Incorrect price code');
        }
    }

    public function getTitle(): string {
        return $this->_title;
    }

    public function getFrequentRenterPoints(int $daysRented): int {
        return $this->_price->getFrequentRenterPoints($daysRented);
    }

    public function getCharge(int $daysRented): float {
        return $this->_price->getCharge($daysRented);
    }
}
