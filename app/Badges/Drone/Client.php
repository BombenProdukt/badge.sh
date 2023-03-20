<?php

declare(strict_types=1);

namespace App\Badges\Drone;

use Illuminate\Support\Facades\Http;

final class Client
{
    public function status(string $user, string $repo, ?string $branch): array
    {
        return Http::baseUrl('https://cloud.drone.io/api')
            ->withToken(config('services.drone.token'))
            ->throw()
            ->get("repos/{$user}/{$repo}/builds/latest", ['ref' => $branch ? "refs/heads/{$branch}" : null])
            ->json('status');
    }
}
