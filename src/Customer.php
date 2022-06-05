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
            $thisAmount = 0;
            $each = $this->_rentals[$i];

            // determine amounts for each line
            switch ($each->getMovie()->getPriceCode()) {
                case Movie::REGULAR:
                    $thisAmount += 2;
                    if ($each->getDaysRented() > 2)
                        $thisAmount += ($each->getDaysRented() - 2) * 1.5;
                    break;
                case Movie::NEW_RELEASE:
                    $thisAmount += $each->getDaysRented() * 3;
                    break;
                case Movie::CHILDREN:
                    $thisAmount += 1.5;
                    if ($each->getDaysRented() > 3)
                        $thisAmount += ($each->getDaysRented() - 3) * 1.5;
                    break;
            }

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
}
