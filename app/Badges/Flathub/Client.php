<?php

declare(strict_types=1);

namespace App\Badges\Flathub;

use Illuminate\Support\Facades\Http;

final class Client
{
    public function downloads(string $packageName): int
    {
        return Http::get("https://flathub.org/api/v2/stats/{$packageName}")->throw()->json('installs_total');
    }

    public function version(string $packageName): string
    {
        return Http::get("https://flathub.org/api/v1/apps/{$packageName}")->throw()->json('currentReleaseVersion');
    }
}
