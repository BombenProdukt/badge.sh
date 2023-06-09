<?php

declare(strict_types=1);

namespace App\Badges\PyPI;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class FrameworkBadge extends AbstractBadge
{
    protected string $route = '/pypi/framework/{project}';

    protected array $keywords = [
        Category::PLATFORM_SUPPORT,
    ];

    public function handle(string $project): array
    {
        $frameworks = collect($this->client->get($project)['info']['classifiers'])->map(function (string $classifier) {
            if (!\str_starts_with($classifier, 'Framework ::')) {
                return null;
            }

            $classifier = \explode(' :: ', $classifier);

            return ['framework' => $classifier[1], 'version' => $classifier[2] ?? null];
        })->filter();

        return [
            'framework' => $frameworks->first()['framework'],
            'versions' => $frameworks->map->version->filter()->toArray(),
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => $properties['framework'],
            'message' => \implode(' | ', $properties['versions']),
            'messageColor' => 'blue.600',
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'framework',
                path: '/pypi/framework/black',
                data: $this->render(['framework' => 'Django', 'versions' => ['1.11', '2.0', '2.1', '2.2', '3.0', '3.1', '3.2']]),
            ),
            new BadgePreviewData(
                name: 'framework',
                path: '/pypi/framework/plone.volto',
                data: $this->render(['framework' => 'Plone', 'versions' => ['5.2']]),
            ),
        ];
    }
}
