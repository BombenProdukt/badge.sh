<?php

declare(strict_types=1);

namespace App\Badges\PyPI\Badges;

use App\Enums\Category;

final class PythonBadge extends AbstractBadge
{
    protected array $routes = [
        '/pypi/python-version/{project}',
    ];

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
                ->implode('version', ' | '),
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'python',
            'message' => $properties['versions'],
            'messageColor' => 'blue.600',
        ];
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/pypi/python-version/black' => 'python version',
        ];
    }
}
