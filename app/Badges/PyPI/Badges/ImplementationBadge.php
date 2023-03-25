<?php

declare(strict_types=1);

namespace App\Badges\PyPI\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class ImplementationBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/pypi/implementation/{project}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
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
