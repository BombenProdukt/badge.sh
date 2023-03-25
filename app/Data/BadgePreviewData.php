<?php

declare(strict_types=1);

namespace App\Data;

use Spatie\LaravelData\Data;

final class BadgePreviewData extends Data
{
    public function __construct(
        public readonly string $name,
        public readonly string $path,
        public readonly array $data,
    ) {
        //
    }
}
