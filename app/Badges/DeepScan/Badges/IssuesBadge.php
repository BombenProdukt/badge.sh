<?php

declare(strict_types=1);

namespace App\Badges\DeepScan\Badges;

use App\Enums\Category;
use PreemStudio\Formatter\FormatNumber;

final class IssuesBadge extends AbstractBadge
{
    protected array $routes = [
        '/deepscan/issues/team/{teamId}/project/{projectId}/branch/{branchId}',
    ];

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $teamId, string $projectId, string $branchId): array
    {
        return [
            'count' => $this->client->get($teamId, $projectId, $branchId)['outstandingDefectCount'],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'issues',
            'message' => FormatNumber::execute($properties['count']),
            'messageColor' => $properties['count'] ? 'green.600' : 'yellow.600',
        ];
    }

    public function previews(): array
    {
        return [
            '/deepscan/issues/team/8527/project/10741/branch/152550' => 'issues',
            '/deepscan/issues/team/7382/project/9494/branch/123838' => 'issues',
        ];
    }
}
