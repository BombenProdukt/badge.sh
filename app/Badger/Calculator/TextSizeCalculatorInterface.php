<?php

declare(strict_types=1);

namespace App\Badger\Calculator;

interface TextSizeCalculatorInterface
{
    public function calculateWidth(string $text): float;
}
