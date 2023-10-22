<?php

namespace App\Patterns\Decorator;

class TextFormat implements InputFormat
{
    public function __construct(
        protected InputFormat $inputFormat
    ) {}

    public function formatText(string $text): string {
        return $this->inputFormat->formatText($text);
    }
}