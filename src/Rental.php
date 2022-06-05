<?php

namespace App;

class Rental
{
    private Movie $_movie;
    private int $_daysRented;

    public function __construct(Movie $_movie, int $_daysRented) {
        $this->_movie = $_movie;
        $this->_daysRented = $_daysRented;
    }

    public function getMovie(): Movie {
        return $this->_movie;
    }

    public function getDaysRented(): int {
        return $this->_daysRented;
    }

    public function getCharge(): float {
        $thisAmount = 0;

        switch ($this->getMovie()->getPriceCode()) {
            case Movie::REGULAR:
                $thisAmount += 2;
                if ($this->getDaysRented() > 2)
                    $thisAmount += ($this->getDaysRented() - 2) * 1.5;
                break;
            case Movie::NEW_RELEASE:
                $thisAmount += $this->getDaysRented() * 3;
                break;
            case Movie::CHILDREN:
                $thisAmount += 1.5;
                if ($this->getDaysRented() > 3)
                    $thisAmount += ($this->getDaysRented() - 3) * 1.5;
                break;
        }

        return $thisAmount;
    }
}
