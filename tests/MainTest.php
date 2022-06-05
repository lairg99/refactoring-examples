<?php

namespace Tests;

use App\Customer;
use App\Movie;
use App\Pricing\ChildrenPrice;
use App\Pricing\NewReleasePrice;
use App\Rental;
use PHPUnit\Framework\TestCase;

class MainTest extends TestCase {
    public function test_statement() {
        $customer = new Customer('Han Solo');

        $customer->addRental(new Rental(
            new Movie("Back to the future", NewReleasePrice::class), 3,
        ));

        $customer->addRental(new Rental(
            new Movie("Toy Story", ChildrenPrice::class), 2,
        ));

        $customer->addRental(new Rental(
            new Movie("Star Wars", NewReleasePrice::class), 5,
        ));

        $expected = "Rental Record for Han Solo
\tBack to the future\t9
\tToy Story\t1.5
\tStar Wars\t15
Amount owed is 25.5
You earned 5 frequent renter points";

        $this->assertEquals($expected, $customer->statement());
    }
}
