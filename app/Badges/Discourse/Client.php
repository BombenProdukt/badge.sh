<?php

declare(strict_types=1);

namespace App\Badges\Discourse;

use Illuminate\Support\Facades\Http;

final class Client
{
    public function statistics(string $server): array
    {
        return Http::baseUrl($server)->throw()->get('site/statistics.json')->json();
    }
}
