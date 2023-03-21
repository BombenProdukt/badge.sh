<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Badges\AbstractBadge;
use App\Badges\GitHub\Client;
use App\Badges\Templates\NumberTemplate;
use GrahamCampbell\GitHub\Facades\GitHub;
use Illuminate\Routing\Route;

final class TopLanguageBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $owner, string $repo): array
    {
        $languages = GitHub::repos()->languages($owner, $repo);

        return NumberTemplate::make(array_key_first($languages), head($languages));
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
        return [];
    }

    public function routePaths(): array
    {
        return [
            '/github/top-language/{owner}/{repo}',
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
            '/github/top-language/micromatch/micromatch' => 'top language',

        ];
    }
}
