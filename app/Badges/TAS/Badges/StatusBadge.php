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
        return $this->client->get($provider, $org, $repo);
    }

    public function render(array $properties): array
    {
        return [
            'label'        => $this->service(),
            'message'      => $properties['status'] === 'failed'
                ? sprintf('%s passed, %s failed, %s skipped, %s total', $properties['passed'], $properties['failed'], $properties['skipped'], $properties['total_tests'])
                : $properties['status'],
            'messageColor' => DetermineColorByStatus::execute($properties['status']),
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
