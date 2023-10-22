<?php

namespace App\Patterns\Decorator;

interface InputFormat
{
    public function formatText(string $text): string;
}