<?php

declare(strict_types=1);

namespace App\Badges\AUR\Badges;

use App\Badges\AbstractBadge;
use App\Badges\AUR\Client;
use App\Badges\Templates\DateTemplate;
use Illuminate\Routing\Route;

final class LastModifiedBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $package): array
    {
        return DateTemplate::make('last modified', $this->client->get($package)['LastModified']);
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
            '/aur/last-modified/{package}',
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
            '/aur/last-modified/google-chrome' => 'last modified',
        ];
    }
}
