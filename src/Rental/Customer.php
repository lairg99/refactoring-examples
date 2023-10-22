<?php

namespace App\Rental;

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

    public function getTotalFrequentRenterPoints(): int {
        return $this->rentals->sum->getFrequentRenterPoints();
    }

    public function getTotalCharge(): float {
        return $this->rentals->sum->getCharge();
    }

    public function getRentals(): Collection {
        return $this->rentals;
    }
}
