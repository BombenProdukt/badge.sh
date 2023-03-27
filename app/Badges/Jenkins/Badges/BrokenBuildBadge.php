<?php

declare(strict_types=1);

namespace App\Badges\Jenkins\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use PreemStudio\Formatter\FormatNumber;

final class BrokenBuildBadge extends AbstractBadge
{
    protected string $route = '/jenkins/broken-build/{hostname}/{job:wildcard}';

    protected array $keywords = [
        Category::BUILD,
    ];

    public function handle(string $hostname, string $job): array
    {
        return [
            'count' => collect($this->client->builds($hostname, $job))->filter(fn (array $build) => \mb_strtolower($build['result']) !== 'success')->count(),
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'Broken Builds',
            'message' => FormatNumber::execute((float) $properties['count']),
            'messageColor' => match (true) {
                $properties['count'] < 10 => 'green.600',
                $properties['count'] < 20 => 'orange.600',
                default => 'red.600',
            },
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: '# of broken builds',
                path: '/jenkins/broken-build/jenkins.mono-project.com/job/test-mono-mainline',
                data: $this->render(['count' => 0]),
            ),
        ];
    }
}
