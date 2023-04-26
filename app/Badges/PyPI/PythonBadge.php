<?php

declare(strict_types=1);

namespace App\Badges\PyPI;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class PythonBadge extends AbstractBadge
{
    protected string $route = '/pypi/python-version/{project}';

    protected array $keywords = [
        Category::PLATFORM_SUPPORT,
    ];

    public function handle(string $project): array
    {
        return [
            'versions' => collect($this->client->get($project)['info']['classifiers'])
                ->map(function (string $classifier) {
                    \preg_match('/^Programming Language :: Python :: ([\d.]+)( :: Only)?$/i', $classifier, $matches);

                    if (empty($matches)) {
                        return [];
                    }

                    return [
                        'version' => $matches[1],
                        'isExclusive' => isset($matches[2]),
                    ];
                })
                ->filter()
                ->unique(fn (array $item) => $item['version'])
                ->pluck('version'),
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'python',
            'message' => \implode(' | ', $properties['versions']),
            'messageColor' => 'blue.600',
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'python version',
                path: '/pypi/python-version/black',
                data: $this->render(['versions' => ['3.6', '3.7', '3.8', '3.9']]),
            ),
        ];
    }
}
