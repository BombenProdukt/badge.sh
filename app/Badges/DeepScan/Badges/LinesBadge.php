<?php

declare(strict_types=1);

namespace App\Badges\DeepScan\Badges;

use App\Badges\DeepScan\Client;
use App\Badges\Templates\LinesTemplate;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class LinesBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $teamId, string $projectId, string $branchId): array
    {
        $response = $this->client->get($teamId, $projectId, $branchId);

        return LinesTemplate::make($response['loc']);
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
            '/deepscan/team/{teamId}/project/{projectId}/branch/{branchId}/lines',
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
            '/deepscan/team/8527/project/10741/branch/152550/lines' => 'lines',
            '/deepscan/team/7382/project/9494/branch/123838/lines'  => 'lines',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
