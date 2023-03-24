<?php

declare(strict_types=1);

namespace App\Badges\CiiBestPractices\Badges;

use App\Actions\DetermineColorByStatus;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class SummaryBadge extends AbstractBadge
{
    public function handle(string $projectId): array
    {
        $response = $this->client->get($projectId);

        return $this->renderText('cii', match (true) {
            $response['tiered_percentage'] < 100 => "in progress {$response['tiered_percentage']}%",
            $response['tiered_percentage'] < 200 => 'passing',
            $response['tiered_percentage'] < 300 => 'silver',
            default                              => 'gold',
        }, DetermineColorByStatus::execute($response['badge_level']));
    }

    public function keywords(): array
    {
        return [Category::ANALYSIS];
    }

    public function routePaths(): array
    {
        return [
            '/cii/summary/{projectId}',
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
            '/cii/summary/33' => 'summary',
        ];
    }
}
