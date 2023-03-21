<?php

declare(strict_types=1);

namespace App\Badges\ClearlyDefined\Badges;

use App\Badges\AbstractBadge;
use App\Badges\ClearlyDefined\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class ScoreBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $type, string $provider, string $namespace, string $name, string $revision): array
    {
        return $this->renderNumber('score', $this->client->get($type, $provider, $namespace, $name, $revision)['scores']['effective']);
    }

    public function service(): string
    {
        return 'ClearlyDefined';
    }

    public function keywords(): array
    {
        return [Category::ANALYSIS];
    }

    public function routePaths(): array
    {
        return [
            '/clearlydefined/score/{type}/{provider}/{namespace}/{name}/{revision}',
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
            '/clearlydefined/score/npm/npmjs/-/jquery/3.4.1' => 'score',
        ];
    }
}
