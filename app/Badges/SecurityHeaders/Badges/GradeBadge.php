<?php

declare(strict_types=1);

namespace App\Badges\SecurityHeaders\Badges;

use App\Badges\SecurityHeaders\Client;
use App\Badges\Templates\GradeTemplate;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class GradeBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $url): array
    {
        return GradeTemplate::make('security headers', $this->client->grade($url));
    }

    public function service(): string
    {
        return 'Security Headers';
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
            '/security-headers/grade/{url}/',
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
            '/security-headers/grade/shields.io' => 'grade',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
