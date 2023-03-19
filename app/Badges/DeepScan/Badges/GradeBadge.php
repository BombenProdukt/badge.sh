<?php

declare(strict_types=1);

namespace App\Badges\DeepScan\Badges;

use App\Badges\DeepScan\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class GradeBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $teamId, string $projectId, string $branchId): array
    {
        $response = $this->client->get($teamId, $projectId, $branchId);

        return [
            'label'       => 'deepscan',
            'status'      => strtolower($response['grade']),
            'statusColor' => [
                'none'   => 'cecece',
                'good'   => '89b414',
                'normal' => '2148b1',
                'poor'   => 'ff5a00',
            ][strtolower($response['grade'])],
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
            '/deepscan/team/{teamId}/project/{projectId}/branch/{branchId}/grade',
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
            '/deepscan/team/7382/project/9494/branch/123838/grade'  => 'grade',
            '/deepscan/team/279/project/1302/branch/3514/grade'     => 'grade',
            '/deepscan/team/8527/project/10741/branch/152550/grade' => 'grade',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
