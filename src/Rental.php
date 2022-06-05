<?php

namespace App;

class Rental
{
    private Movie $movie;
    private int $daysRented;

    public function __construct(Movie $movie, int $daysRented) {
        $this->movie = $movie;
        $this->daysRented = $daysRented;
    }

    public function getMovie(): Movie {
        return $this->movie;
    }

    public function getDaysRented(): int {
        return $this->daysRented;
    }

    public function getFrequentRenterPoints(): int {
        return $this->movie->getFrequentRenterPoints($this->daysRented);
    }

    public function getCharge(): float {
        return $this->movie->getCharge($this->daysRented);
    }
}
