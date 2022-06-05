<?php

namespace Tests;

use App\Customer;
use App\Movie;
use App\Rental;
use PHPUnit\Framework\TestCase;

class MainTest extends TestCase {
    public function test_statement() {
        $customer = new Customer('Han Solo');

        $customer->addRental(new Rental(
            new Movie("Back to the future", Movie::NEW_RELEASE), 3,
        ));

        $customer->addRental(new Rental(
            new Movie("Toy Story", Movie::CHILDREN), 2,
        ));

        $customer->addRental(new Rental(
            new Movie("Star Wars", Movie::NEW_RELEASE), 5,
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
