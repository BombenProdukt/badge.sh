<?php

declare(strict_types=1);

namespace App\Badges\TAS\Badges;

use App\Actions\DetermineColorByStatus;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class StatusBadge extends AbstractBadge
{
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

    public function keywords(): array
    {
        return [Category::TEST_RESULTS];
    }

    public function routePaths(): array
    {
        return [
            '/tas/tests/{provider}/{org}/{repo}',
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
            '/tas/tests/github/tasdemo/axios' => 'license',
        ];
    }
}
