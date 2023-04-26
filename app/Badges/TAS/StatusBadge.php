<?php

declare(strict_types=1);

namespace App\Badges\TAS;

use App\Actions\DetermineColorByStatus;
use App\Data\BadgePreviewData;
use App\Enums\Category;

final class StatusBadge extends AbstractBadge
{
    protected string $route = '/tas/tests/{provider}/{org}/{repo}';

    protected array $keywords = [
        Category::TEST_RESULTS,
    ];

    public function handle(string $provider, string $org, string $repo): array
    {
        return $this->client->get($provider, $org, $repo);
    }

    public function render(array $properties): array
    {
        return [
            'label' => $this->service(),
            'message' => $properties['status'] === 'failed'
                ? \sprintf('%s passed, %s failed, %s skipped, %s total', $properties['passed'], $properties['failed'], $properties['skipped'], $properties['total_tests'])
                : $properties['status'],
            'messageColor' => DetermineColorByStatus::execute($properties['status']),
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'license',
                path: '/tas/tests/github/tasdemo/axios',
                data: $this->render([
                    'status' => 'passed',
                    'passed' => 1,
                    'failed' => 0,
                    'skipped' => 0,
                    'total_tests' => 1,
                ]),
            ),
        ];
    }
}
