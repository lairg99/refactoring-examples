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

    public function getFrequentRenterPoints(): int {
        if(($this->getMovie()->getPriceCode() == Movie::NEW_RELEASE) && $this->getDaysRented() > 1) {
            return 2;
        }

        return 1;
    }

    public function getCharge(): float {
        return $this->_movie->getCharge($this->_daysRented);
    }
}
