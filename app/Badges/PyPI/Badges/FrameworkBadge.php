<?php

declare(strict_types=1);

namespace App\Badges\PyPI\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class FrameworkBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/pypi/framework/{project}',
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
            '/pypi/framework/black' => 'framework',
            '/pypi/framework/plone.volto' => 'framework',
        ];
    }
}
