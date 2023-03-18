<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Badges\GitHub\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Http;

final class DependabotStatusBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $owner, string $repo): array
    {
        // Since there is no API to get dependabot status, for now check if file exists
        $request = Http::get("https://api.github.com/repos/{$owner}/{$repo}/contents/.github/dependabot.yml");

        if ($request->successful()) {
            return [
                'label'       => 'dependabot',
                'status'      => 'Active',
                'statusColor' => 'green.600',
            ];
        }

        return [
            'label'       => 'github',
            'status'      => 'not found',
            'statusColor' => 'gray.600',
        ];
    }

    public function service(): string
    {
        return 'GitHub';
    }

    public function title(): string
    {
        return '';
    }

    public function keywords(): array
    {
        return [
            //
        ];
    }

    public function routePaths(): array
    {
        return [
            '/github/dependabot/{owner}/{repo}',
        ];
    }

    public function routeParameters(): array
    {
        return [
            //
        ];
    }

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPreviews(): array
    {
        return [
            //
        ];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/github/dependabot/ubuntu/yaru' => 'dependabot status',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
