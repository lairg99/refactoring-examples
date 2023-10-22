<?php

namespace App\Rental\Printer;

use App\Rental\Customer;

abstract class Printer
{
    public function __construct(protected Customer $customer) {}

    public abstract function print(): string;
}
