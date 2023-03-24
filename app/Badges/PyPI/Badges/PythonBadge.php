<?php

declare(strict_types=1);

namespace App\Badges\PyPI\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class PythonBadge extends AbstractBadge
{
    public function handle(string $project): array
    {
        $versions = collect($this->client->get($project)['info']['classifiers'])
            ->map(function (string $classifier) {
                preg_match('/^Programming Language :: Python :: ([\d.]+)( :: Only)?$/i', $classifier, $matches);

                if (empty($matches)) {
                    return [];
                }

                return [
                    'version'     => $matches[1],
                    'isExclusive' => isset($matches[2]),
                ];
            })
            ->filter()
            ->unique(fn (array $item) => $item['version'])
            ->implode('version', ' | ');

        return [
            'label'        => 'python',
            'message'      => $versions,
            'messageColor' => 'blue.600',
        ];
    }

    public function keywords(): array
    {
        return [Category::PLATFORM_SUPPORT];
    }

    public function routePaths(): array
    {
        return [
            '/pypi/python-version/{project}',
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
            '/pypi/python-version/black' => 'python version',
        ];
    }
}
