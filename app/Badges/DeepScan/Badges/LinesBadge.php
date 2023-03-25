<?php

declare(strict_types=1);

namespace App\Badges\DeepScan\Badges;

use App\Enums\Category;

final class LinesBadge extends AbstractBadge
{
    protected array $routes = [
        '/deepscan/lines/team/{teamId}/project/{projectId}/branch/{branchId}',
    ];

    protected array $keywords = [
        Category::ANALYSIS,
    ];

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

    public function previews(): array
    {
        return [
            '/deepscan/lines/team/8527/project/10741/branch/152550' => 'lines',
            '/deepscan/lines/team/7382/project/9494/branch/123838' => 'lines',
        ];
    }
}
