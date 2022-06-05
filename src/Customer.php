<?php

namespace App;

class Customer
{
    private string $_name;

    /** @var array<Rental> */
    private array $_rentals = [];

    public function __construct(string $_name) {
        $this->_name = $_name;
    }

    public function addRental(Rental $rental): void {
        $this->_rentals[] = $rental;
    }

    public function getName(): string {
        return $this->_name;
    }

    public function statement(): string {
        $totalAmount = 0;
        $frequentRenterPoints = 0;

        $result = 'Rental Record for ' . $this->getName() . "\n";

        for ($i = 0; $i < count($this->_rentals); $i++) {
            $each = $this->_rentals[$i];

            // add frequent renter points
            $frequentRenterPoints += $each->getFrequentRenterPoints();

            // show figures for this rental
            $result .= "\t" . $each->getMovie()->getTitle() . "\t" . $each->getCharge() . "\n";
        }

        // add footer lines
        $result .= 'Amount owed is ' . $this->getTotalCharge() . "\n";
        $result .= 'You earned ' . $frequentRenterPoints . ' frequent renter points';

        return $result;
    }

    private function getTotalCharge(): float {
        $result = 0;

        for ($i = 0; $i < count($this->_rentals); $i++) {
            $each = $this->_rentals[$i];

            $result += $each->getCharge();
        }

        return $result;
    }
}
