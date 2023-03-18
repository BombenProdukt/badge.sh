<?php

declare(strict_types=1);

namespace App\Badges\DeepScan\Badges;

use App\Actions\FormatNumber;
use App\Badges\DeepScan\Client;
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

        return [
            'label'       => 'lines',
            'status'      => FormatNumber::execute($response['loc']),
            'statusColor' => 'blue.600',
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
            '/deepscan/lines/team/{teamId}/project/{projectId}/branch/{branchId}',
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
            '/deepscan/lines/team/8527/project/10741/branch/152550' => 'lines',
            '/deepscan/lines/team/7382/project/9494/branch/123838'  => 'lines',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
