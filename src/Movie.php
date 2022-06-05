<?php

namespace App;

class Movie
{
    const CHILDREN = 2;
    const REGULAR = 0;
    const NEW_RELEASE = 1;

    private string $_title;
    private int $_priceCode;

    public function __construct(string $_title, int $_priceCode) {
        $this->_title = $_title;
        $this->setPriceCode($_priceCode);
    }

    public function getPriceCode(): int {
        return $this->_priceCode;
    }

    public function setPriceCode(int $priceCode): void {
        $this->_priceCode = $priceCode;
    }

    public function getTitle(): string {
        return $this->_title;
    }

    public function getFrequentRenterPoints(int $daysRented): int {
        if(($this->getPriceCode() == Movie::NEW_RELEASE) && $daysRented > 1) {
            return 2;
        }

        return 1;
    }

    public function getCharge(int $daysRented): float {
        $thisAmount = 0;

        switch ($this->getPriceCode()) {
            case Movie::REGULAR:
                $thisAmount += 2;
                if ($daysRented > 2)
                    $thisAmount += ($daysRented - 2) * 1.5;
                break;
            case Movie::NEW_RELEASE:
                $thisAmount += $daysRented * 3;
                break;
            case Movie::CHILDREN:
                $thisAmount += 1.5;
                if ($daysRented > 3)
                    $thisAmount += ($daysRented - 3) * 1.5;
                break;
        }

        return $thisAmount;
    }
}
