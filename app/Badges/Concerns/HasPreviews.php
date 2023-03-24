<?php

declare(strict_types=1);

namespace App\Badges\Concerns;

trait HasPreviews
{
    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [];
    }
}
