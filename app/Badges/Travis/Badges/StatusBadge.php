<?php

declare(strict_types=1);

namespace App\Badges\Travis\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Illuminate\Support\Collection;

final class StatusBadge extends AbstractBadge
{
    protected string $route = '/travis/status/{project:packageWithVendorOnly}/{branch?}';

    protected array $keywords = [
        Category::BUILD,
    ];

    public function handle(string $project, ?string $branch = null): array
    {
        $org = $this->client->org($project, $branch);
        $com = $this->client->com($project, $branch);

        $result = $this->availableStates()->firstWhere(fn (array $state) => \str_contains($org, $state[0]) || \str_contains($com, $state[0]));

        return [
            'status' => $result[0],
            'statusColor' => $result[1],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderText('travis', $properties['status'], $properties['statusColor']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'build',
                path: '/travis/status/babel/babel',
                data: $this->render(['status' => 'success', 'statusColor' => 'green.600']),
            ),
            new BadgePreviewData(
                name: 'build (branch)',
                path: '/travis/status/babel/babel/6.x',
                data: $this->render(['status' => 'success', 'statusColor' => 'green.600']),
            ),
        ];
    }

    private function availableStates(): Collection
    {
        return collect([
            ['broken', 'red.600'],
            ['canceled', 'gray.600'],
            ['error', 'red.600'],
            ['errored', 'red.600'],
            ['failed', 'red.600'],
            ['failing', 'red.600'],
            ['fixed', 'yellow.600'],
            ['passed', 'green.600'],
            ['passing', 'green.600'],
            ['pending', 'yellow.600'],
        ]);
    }
}
