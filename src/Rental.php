<?php

namespace App;

class Rental
{
    public function __construct(
        private readonly Movie $movie,
        private readonly int $daysRented
    ) {}

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
