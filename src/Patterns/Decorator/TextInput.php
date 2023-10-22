<?php

namespace App\Patterns\Decorator;

class TextInput implements InputFormat
{
    public function formatText(string $text): string {
        return $text;
    }
}