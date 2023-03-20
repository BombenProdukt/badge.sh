<?php

declare(strict_types=1);

namespace App\Badges\ClearlyDefined\Badges;

use App\Badges\ClearlyDefined\Client;
use App\Badges\Templates\LicenseTemplate;
use App\Badges\Templates\NumberTemplate;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class ScoreBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $type, string $provider, string $namespace, string $name, string $revision): array
    {
        return NumberTemplate::make('score', $this->client->get($type, $provider, $namespace, $name, $revision)['scores']['effective']);
    }

    public function service(): string
    {
        return 'ClearlyDefined';
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
            '/clearlydefined/score/{type}/{provider}/{namespace}/{name}/{revision}',
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
            '/clearlydefined/score/npm/npmjs/-/jquery/3.4.1' => 'score',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
