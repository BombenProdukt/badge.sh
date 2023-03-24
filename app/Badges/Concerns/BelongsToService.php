<?php

declare(strict_types=1);

namespace App\Badges\Concerns;

use Illuminate\Support\Str;

trait BelongsToService
{
    public function service(): string
    {
        return '';
    }

    public function title(): string
    {
        return explode(' Badge', Str::title(Str::snake(class_basename($this), ' ')))[0];
    }

    public function keywords(): array
    {
        return [];
    }

    public function deprecated(): array
    {
        return [];
    }
}
