<?php

namespace App;

use Illuminate\Support\Collection;

class Customer
{
    /** @var Collection<int, Rental> */
    private Collection $rentals;

    public function __construct(private readonly string $name) {
        $this->rentals = collect();
    }

    public function addRental(Rental $rental): void {
        $this->rentals->add($rental);
    }

    public function getName(): string {
        return $this->name;
    }

    public function statement(): string {
        $result = 'Rental Record for ' . $this->getName() . "\n";

        for ($i = 0; $i < count($this->rentals); $i++) {
            $each = $this->rentals[$i];

            // show figures for this rental
            $result .= "\t" . $each->getMovie()->getTitle() . "\t" . $each->getCharge() . "\n";
        }

        // add footer lines
        $result .= 'Amount owed is ' . $this->getTotalCharge() . "\n";
        $result .= 'You earned ' . $this->getTotalFrequentRenterPoints() . ' frequent renter points';

        return $result;
    }

    private function getTotalFrequentRenterPoints(): int {
        return $this->rentals->sum->getFrequentRenterPoints();
    }

    private function getTotalCharge(): float {
        return $this->rentals->sum->getCharge();
    }
}
