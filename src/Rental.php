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
}
