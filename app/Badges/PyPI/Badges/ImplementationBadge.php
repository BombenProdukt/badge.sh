<?php

declare(strict_types=1);

namespace App\Badges\PyPI\Badges;

use App\Badges\AbstractBadge;
use App\Badges\PyPI\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class ImplementationBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $project): array
    {
        $implementation = collect($this->client->get($project)['info']['classifiers'])->map(function (string $classifier) {
            preg_match('/^Programming Language :: Python :: Implementation :: (\d+)$/', $classifier, $matches);

            if (empty($matches)) {
                return null;
            }

            return $matches[1];
        })->filter()->first();

        return [
            'label'        => 'implementation',
            'message'      => empty($implementation) ? 'cpython' : $implementation,
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
        return [Category::PLATFORM_SUPPORT];
    }

    public function routePaths(): array
    {
        return [
            '/pypi/implementation/{project}',
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
            '/pypi/implementation/black' => 'framework',
        ];
    }
}
