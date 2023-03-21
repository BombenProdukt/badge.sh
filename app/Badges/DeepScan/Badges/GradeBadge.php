<?php

declare(strict_types=1);

namespace App\Badges\DeepScan\Badges;

use App\Badges\AbstractBadge;
use App\Badges\DeepScan\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class GradeBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $teamId, string $projectId, string $branchId): array
    {
        $response = $this->client->get($teamId, $projectId, $branchId);

        return [
            'label'        => 'deepscan',
            'message'      => strtolower($response['grade']),
            'messageColor' => [
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

    public function keywords(): array
    {
        return [Category::ANALYSIS];
    }

    public function routePaths(): array
    {
        return [
            '/deepscan/grade/team/{teamId}/project/{projectId}/branch/{branchId}',
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
            '/deepscan/grade/team/7382/project/9494/branch/123838'  => 'grade',
            '/deepscan/grade/team/279/project/1302/branch/3514'     => 'grade',
            '/deepscan/grade/team/8527/project/10741/branch/152550' => 'grade',
        ];
    }
}
