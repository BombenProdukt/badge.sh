<?php

declare(strict_types=1);

namespace App\Badges\DeepScan\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class IssuesBadge extends AbstractBadge
{
    public function handle(string $teamId, string $projectId, string $branchId): array
    {
        $response = $this->client->get($teamId, $projectId, $branchId);

        return [
            'label'        => 'issues',
            'message'      => FormatNumber::execute($response['outstandingDefectCount']),
            'messageColor' => $response['outstandingDefectCount'] ? 'green.600' : 'yellow.600',
        ];
    }

    public function keywords(): array
    {
        return [Category::ANALYSIS];
    }

    public function routePaths(): array
    {
        return [
            '/deepscan/issues/team/{teamId}/project/{projectId}/branch/{branchId}',
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
            '/deepscan/issues/team/8527/project/10741/branch/152550' => 'issues',
            '/deepscan/issues/team/7382/project/9494/branch/123838'  => 'issues',
        ];
    }
}
