<?php

declare(strict_types=1);

namespace App\Badges\Docker\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class StarsBadge extends AbstractBadge
{
    public function handle(string $scope, string $name): array
    {
        return [
            'label'        => 'docker pulls',
            'message'      => FormatNumber::execute($this->client->info($scope, $name)['star_count']),
            'messageColor' => 'blue.600',
        ];
    }

    public function keywords(): array
    {
        return [Category::RATING];
    }

    public function routePaths(): array
    {
        return [
            '/docker/stars/{scope}/{name}',
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
            '/docker/stars/library/ubuntu' => 'stars (library)',
            '/docker/stars/library/mongo'  => 'stars (icon & label)',
        ];
    }
}
