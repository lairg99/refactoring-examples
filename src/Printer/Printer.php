<?php

namespace App\Printer;

use App\Customer;

abstract class Printer
{
    public function __construct(protected Customer $customer) {}

    public abstract function print(): string;
}
