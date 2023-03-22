<?php

declare(strict_types=1);

namespace App\Badges\CiiBestPractices\Badges;

use App\Actions\DetermineColorByStatus;
use App\Badges\AbstractBadge;
use App\Badges\CiiBestPractices\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class LevelBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $projectId): array
    {
        $response = $this->client->get($projectId);

        return $this->renderText('cii', $response['badge_level'], DetermineColorByStatus::execute($response['badge_level']));
    }

    public function service(): string
    {
        return 'CII Best Practices';
    }

    public function keywords(): array
    {
        return [Category::ANALYSIS];
    }

    public function routePaths(): array
    {
        return [
            '/cii/level/{projectId}',
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
            '/cii/level/1' => 'level',
        ];
    }
}
