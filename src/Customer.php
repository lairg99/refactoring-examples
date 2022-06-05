<?php

namespace App;

class Customer
{
    /** @var array<Rental> */
    private array $rentals = [];

    public function __construct(private readonly string $name) {}

    public function addRental(Rental $rental): void {
        $this->rentals[] = $rental;
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
        $result = 0;

        foreach ($this->rentals as $rental) {
            $result += $rental->getFrequentRenterPoints();
        }

        return $result;
    }

    private function getTotalCharge(): float {
        $result = 0;

        foreach ($this->rentals as $rental) {
            $result += $rental->getCharge();
        }

        return $result;
    }
}
