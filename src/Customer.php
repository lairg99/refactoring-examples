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

            $thisAmount = $this->amountFor($each);

            // add frequent renter points
            $frequentRenterPoints++;
            // add bonus for a two days new release rental
            if(($each->getMovie()->getPriceCode() == Movie::NEW_RELEASE) &&
                $each->getDaysRented() > 1) $frequentRenterPoints++;

            // show figures for this rental
            $result .= "\t" . $each->getMovie()->getTitle() . "\t" . $thisAmount . "\n";

            $totalAmount += $thisAmount;
        }

        // add footer lines
        $result .= 'Amount owed is ' . $totalAmount . "\n";
        $result .= 'You earned ' . $frequentRenterPoints . ' frequent renter points';

        return $result;
    }

    private function amountFor(Rental $rental): float {
        $thisAmount = 0;

        switch ($rental->getMovie()->getPriceCode()) {
            case Movie::REGULAR:
                $thisAmount += 2;
                if ($rental->getDaysRented() > 2)
                    $thisAmount += ($rental->getDaysRented() - 2) * 1.5;
                break;
            case Movie::NEW_RELEASE:
                $thisAmount += $rental->getDaysRented() * 3;
                break;
            case Movie::CHILDREN:
                $thisAmount += 1.5;
                if ($rental->getDaysRented() > 3)
                    $thisAmount += ($rental->getDaysRented() - 3) * 1.5;
                break;
        }

        return $thisAmount;
    }
}
