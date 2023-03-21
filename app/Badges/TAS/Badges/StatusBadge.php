<?php

declare(strict_types=1);

namespace App\Badges\TAS\Badges;

use App\Actions\DetermineColorByStatus;
use App\Badges\TAS\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class StatusBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $provider, string $org, string $repo): array
    {
        $response = $this->client->get($provider, $org, $repo);

        return [
            'label'        => $this->service(),
            'message'      => $response['status'] === 'failed'
                ? sprintf('%s passed, %s failed, %s skipped, %s total', $response['passed'], $response['failed'], $response['skipped'], $response['total_tests'])
                : $response['status'],
            'messageColor' => DetermineColorByStatus::execute($response['status']),
        ];
    }

    public function service(): string
    {
        return 'TAS';
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
            '/tas/tests/{provider}/{org}/{repo}',
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
            '/tas/tests/github/tasdemo/axios' => 'license',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
