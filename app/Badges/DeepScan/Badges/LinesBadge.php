<?php

declare(strict_types=1);

namespace App\Badges\DeepScan\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class LinesBadge extends AbstractBadge
{
    public function handle(string $teamId, string $projectId, string $branchId): array
    {
        return [
            'lines' => $this->client->get($teamId, $projectId, $branchId)['loc'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderLines($properties['lines']);
    }

    public function keywords(): array
    {
        return [Category::ANALYSIS];
    }

    public function routePaths(): array
    {
        return [
            '/deepscan/lines/team/{teamId}/project/{projectId}/branch/{branchId}',
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
            '/deepscan/lines/team/8527/project/10741/branch/152550' => 'lines',
            '/deepscan/lines/team/7382/project/9494/branch/123838'  => 'lines',
        ];
    }
}
