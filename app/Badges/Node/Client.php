<?php

declare(strict_types=1);

namespace App\Badges\Node;

use Illuminate\Support\Facades\Http;

final class Client
{
    public function get(string $package, ?string $tag, ?string $registry): array
    {
        return Http::baseUrl($registry ?? 'https://registry.npmjs.org')->throw()->get("{$package}/{$tag}")->json();
    }
}
