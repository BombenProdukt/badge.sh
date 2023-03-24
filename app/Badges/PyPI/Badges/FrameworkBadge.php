<?php

declare(strict_types=1);

namespace App\Badges\PyPI\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class FrameworkBadge extends AbstractBadge
{
    public function handle(string $project): array
    {
        $frameworks = collect($this->client->get($project)['info']['classifiers'])->map(function (string $classifier) {
            if (! str_starts_with($classifier, 'Framework ::')) {
                return null;
            }

            $classifier = explode(' :: ', $classifier);

            return ['framework' => $classifier[1], 'version' => $classifier[2] ?? null];
        })->filter();

        return [
            'framework' => $frameworks->first()['framework'],
            'versions'  => $frameworks->map->version->filter()->toArray(),
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label'        => $properties['framework'],
            'message'      => implode(' | ', $properties['versions']),
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
            '/pypi/framework/{project}',
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
            '/pypi/framework/black'       => 'framework',
            '/pypi/framework/plone.volto' => 'framework',
        ];
    }
}
