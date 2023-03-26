<?php

declare(strict_types=1);

namespace App\Badges\Bitbucket\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class PipelinesBadge extends AbstractBadge
{
    protected array $routes = [
        '/bitbucket/pipelines/{user}/{repo}/{branch:wildcard?}',
    ];

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $user, string $repo, ?string $branch = null): array
    {
        $values = collect($this->client->pipelines($user, $repo, $branch))
            ->filter(fn (array $value) => $value['state']['name'] === 'COMPLETED');

        if (\count($values) > 0) {
            return [
                'status' => $values[0]['state']['result']['name'],
            ];
        }

        return [
            'status' => 'never built',
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderStatus('build', $properties['status']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'build status',
                path: '/bitbucket/pipelines/atlassian/adf-builder-javascript/task/SECO-2168',
                data: $this->render(['status' => 'SUCCESSFUL']),
            ),
        ];
    }
}
