<?php

declare(strict_types=1);

namespace App\Badges\AUR\Badges;

use App\Badges\AbstractBadge;
use App\Badges\AUR\Client;
use App\Badges\Templates\NumberTemplate;
use Illuminate\Routing\Route;

final class VotesBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $package): array
    {
        return NumberTemplate::make('votes', $this->client->get($package)['NumVotes']);
    }

    public function service(): string
    {
        return 'AUR';
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
            '/aur/votes/{package}',
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
            '/aur/votes/google-chrome' => 'votes',
        ];
    }
}
