<?php

declare(strict_types=1);

namespace App\Badges\Concerns;

use Illuminate\Support\Str;

trait BelongsToService
{
    public function service(): string
    {
        return $this->service ?? '';
    }

    public function title(): string
    {
        return \explode(' Badge', Str::title(Str::snake(class_basename($this), ' ')))[0];
    }

    public function render(array $properties): array
    {
        return $properties;
    }

    public function deprecated(): array
    {
        return [];
    }

    public function keywords(): array
    {
        return $this->keywords ?? [];
    }
}
