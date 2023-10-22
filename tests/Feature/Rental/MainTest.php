<?php

use App\Rental\Customer;
use App\Rental\Movie;
use App\Rental\Pricing\ChildrenPrice;
use App\Rental\Pricing\NewReleasePrice;
use App\Rental\Printer\Console;
use App\Rental\Rental;

test('rental', function () {
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

    $this->assertEquals($expected, (new Console($customer))->print());
});
