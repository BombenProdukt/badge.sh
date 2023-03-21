<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Badges\AbstractBadge;
use App\Badges\GitHub\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Http;

final class DependabotStatusBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $owner, string $repo): array
    {
        $request = Http::get("https://api.github.com/repos/{$owner}/{$repo}/contents/.github/dependabot.yml");

        if ($request->successful()) {
            return [
                'label'        => 'dependabot',
                'message'      => 'Active',
                'messageColor' => 'green.600',
            ];
        }

        return [
            'label'        => 'github',
            'message'      => 'not found',
            'messageColor' => 'gray.600',
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
        return [Category::ANALYSIS, Category::DEPENDENCIES];
    }

    public function routePaths(): array
    {
        return [
            '/github/dependabot/{owner}/{repo}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/github/dependabot/ubuntu/yaru' => 'dependabot status',
        ];
    }
}
