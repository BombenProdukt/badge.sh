<?php

declare(strict_types=1);

namespace App\Badges\CodeClimate\Badges;

use App\Actions\FormatPercentage;
use App\Badges\CodeClimate\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class MaintainabilityPercentageBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $owner, string $repo): array
    {
        $response = $this->client->get($owner, $repo, 'snapshots');

        return [
            'label'       => 'maintainability',
            'status'      => FormatPercentage::execute($response['attributes']['ratings'][0]['measure']['value']),
            'statusColor' => [
                'A' => 'green.600',
                'B' => '9C0',
                'C' => 'AA2',
                'D' => 'DC2',
                'E' => 'orange.600',
            ][$response['attributes']['ratings'][0]['letter']],
        ];
    }

    public function service(): string
    {
        return 'Code Climate';
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
            '/codeclimate/maintainability-percentage/{owner}/{repo}',
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
            '/codeclimate/maintainability-percentage/codeclimate/codeclimate' => 'maintainability (percentage)',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
