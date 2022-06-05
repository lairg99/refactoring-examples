<?php

namespace App\Printer;

use App\Customer;

abstract class Printer
{
    public abstract function print(Customer $customer): string;
}
