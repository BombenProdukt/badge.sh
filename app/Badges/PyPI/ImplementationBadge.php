<?php

declare(strict_types=1);

namespace App\Badges\PyPI;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class ImplementationBadge extends AbstractBadge
{
    protected string $route = '/pypi/implementation/{project}';

    protected array $keywords = [
        Category::PLATFORM_SUPPORT,
    ];

    public function handle(string $project): array
    {
        return [
            'implementation' => collect($this->client->get($project)['info']['classifiers'])->map(function (string $classifier) {
                \preg_match('/^Programming Language :: Python :: Implementation :: (\d+)$/', $classifier, $matches);

                if (empty($matches)) {
                    return null;
                }

                return $matches[1];
            })->filter()->first(),
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'implementation',
            'message' => empty($properties['implementation']) ? 'cpython' : $properties['implementation'],
            'messageColor' => 'blue.600',
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'framework',
                path: '/pypi/implementation/black',
                data: $this->render(['implementation' => 'cpython']),
            ),
        ];
    }
}
