<?php

declare(strict_types=1);

namespace App\Badger\Contracts;

interface IconRenderer
{
    public function render(string $name): string;

    public function matches(string $name): bool;
}
