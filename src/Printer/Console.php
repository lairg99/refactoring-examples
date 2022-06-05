<?php

namespace App\Printer;

use App\Customer;

class Console extends Printer
{
    public function print(Customer $customer): string {
        $result = 'Rental Record for ' . $customer->getName() . "\n";

        foreach ($customer->getRentals() as $rental) {
            // show figures for this rental
            $result .= "\t" . $rental->getMovie()->getTitle() . "\t" . $rental->getCharge() . "\n";
        }

        // add footer lines
        $result .= 'Amount owed is ' . $customer->getTotalCharge() . "\n";
        $result .= 'You earned ' . $customer->getTotalFrequentRenterPoints() . ' frequent renter points';

        return $result;
    }
}
