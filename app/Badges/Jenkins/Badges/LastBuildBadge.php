<?php

declare(strict_types=1);

namespace App\Badges\Jenkins\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class LastBuildBadge extends AbstractBadge
{
    protected string $route = '/jenkins/last-build/{hostname}/{job:wildcard}';

    protected array $keywords = [
        Category::BUILD,
    ];

    public function handle(string $hostname, string $job): array
    {
        return [
            'status' => $this->client->get($hostname, $job, 'lastBuild/api/json?tree=result,timestamp,estimatedDuration')['result'],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'Last Build',
            'message' => $properties['status'],
            'messageColor' => \mb_strtolower($properties['status']) === 'success' ? 'green.600' : 'red.600',
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'Last build status',
                path: '/jenkins/last-build/jenkins.mono-project.com/job/test-mono-mainline',
                data: $this->render(['status' => 'Success']),
            ),
        ];
    }
}
