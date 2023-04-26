<?php

declare(strict_types=1);

namespace App\Badger\Contracts;

interface TextSizeCalculator
{
    public function calculateWidth(string $text): float;
}
