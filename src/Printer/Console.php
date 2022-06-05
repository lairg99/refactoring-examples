<?php

namespace App\Printer;

class Console extends Printer
{
    public function print(): string {
        $result = $this->header();
        $result .= $this->overview();
        $result .= $this->footer();

        return $result;
    }

    private function header(): string {
        return 'Rental Record for ' . $this->customer->getName() . "\n";
    }

    private function footer(): string {
        $footer = 'Amount owed is ' . $this->customer->getTotalCharge() . "\n";
        $footer .= 'You earned ' . $this->customer->getTotalFrequentRenterPoints() . ' frequent renter points';

        return $footer;
    }

    private function overview(): string {
        return $this->customer->getRentals()->map(
            fn($rental) => "\t" . $rental->getMovie()->getTitle() . "\t" . $rental->getCharge() . "\n"
        )->join('');
    }
}
