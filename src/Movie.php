<?php

namespace App;

class Movie
{
    const CHILDREN = 2;
    const REGULAR = 0;
    const NEW_RELEASE = 1;

    private string $_title;
    private int $_priceCode;

    public function __construct(string $_title, int $_priceCode) {
        $this->_title = $_title;
        $this->_priceCode = $_priceCode;
    }

    public function getPriceCode(): int {
        return $this->_priceCode;
    }

    public function setPriceCode(int $priceCode): void {
        $this->_priceCode = $priceCode;
    }

    public function getTitle(): string {
        return $this->_title;
    }
}
