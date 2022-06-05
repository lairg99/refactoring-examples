<?php

namespace App\Printer;

use App\Customer;

class Console extends Printer
{
    public function print(): string {
        $result = 'Rental Record for ' . $this->customer->getName() . "\n";

        foreach ($this->customer->getRentals() as $rental) {
            // show figures for this rental
            $result .= "\t" . $rental->getMovie()->getTitle() . "\t" . $rental->getCharge() . "\n";
        }

        // add footer lines
        $result .= 'Amount owed is ' . $this->customer->getTotalCharge() . "\n";
        $result .= 'You earned ' . $this->customer->getTotalFrequentRenterPoints() . ' frequent renter points';

        return $result;
    }
}
