<?php

declare(strict_types=1);

namespace App\Badges\PyPI\Badges;

use App\Badges\AbstractBadge;
use App\Badges\PyPI\Client;
use Illuminate\Routing\Route;

final class PythonBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

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

    public function service(): string
    {
        return 'PyPI';
    }

    public function title(): string
    {
        return '';
    }

    public function keywords(): array
    {
        return [];
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
