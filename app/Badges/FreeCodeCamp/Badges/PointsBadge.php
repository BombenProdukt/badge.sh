<?php

declare(strict_types=1);

namespace App\Badges\FreeCodeCamp\Badges;

use App\Badges\AbstractBadge;
use App\Badges\FreeCodeCamp\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class PointsBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $username): array
    {
        return [
            'label'        => 'freecodecamp',
            'message'      => FormatNumber::execute($this->client->get($username)['entities']['user'][$username]['points']),
            'messageColor' => 'green.600',
        ];
    }

    public function service(): string
    {
        return 'FreeCodeCamp';
    }

    public function title(): string
    {
        return '';
    }

    public function keywords(): array
    {
        return [Category::SOCIAL];
    }

    public function routePaths(): array
    {
        return [
            '/freecodecamp/points/{username}',
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
            '/freecodecamp/points/sethi' => 'points',
        ];
    }
}
