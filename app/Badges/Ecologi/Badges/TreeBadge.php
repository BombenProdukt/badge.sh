<?php

declare(strict_types=1);

namespace App\Badges\Ecologi\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Ecologi\Client;
use Illuminate\Routing\Route;

final class TreeBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $username): array
    {
        return $this->renderNumber('trees', $this->client->trees($username));
    }

    public function service(): string
    {
        return 'Ecologi';
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
            '/ecologi/trees/{username}',
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
            '/ecologi/trees/ecologi' => 'license',
        ];
    }
}
