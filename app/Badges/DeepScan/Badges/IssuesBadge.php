<?php

declare(strict_types=1);

namespace App\Badges\DeepScan\Badges;

use App\Actions\FormatNumber;
use App\Badges\DeepScan\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class IssuesBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $teamId, string $projectId, string $branchId): array
    {
        $response = $this->client->get($teamId, $projectId, $branchId);

        return [
            'label'       => 'issues',
            'status'      => FormatNumber::execute($response['outstandingDefectCount']),
            'statusColor' => $response['outstandingDefectCount'] ? 'green.600' : 'yellow.600',
        ];
    }

    public function service(): string
    {
        return 'DeepScan';
    }

    public function title(): string
    {
        return '';
    }

    public function keywords(): array
    {
        return [
            //
        ];
    }

    public function routePaths(): array
    {
        return [
            '/deepscan/issues/team/{teamId}/project/{projectId}/branch/{branchId}',
        ];
    }

    public function routeParameters(): array
    {
        return [
            //
        ];
    }

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPreviews(): array
    {
        return [
            //
        ];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/deepscan/issues/team/8527/project/10741/branch/152550' => 'issues',
            '/deepscan/issues/team/7382/project/9494/branch/123838'  => 'issues',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
