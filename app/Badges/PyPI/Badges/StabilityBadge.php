<?php

declare(strict_types=1);

namespace App\Badges\PyPI\Badges;

use App\Actions\DetermineColorByVersion;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class StabilityBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/pypi/stability/{project}',
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
        $stability = collect($this->client->get($project)['info']['classifiers'])->map(function (string $classifier) {
            // Development Status :: 1 - Planning
            // Development Status :: 2 - Pre-Alpha
            // Development Status :: 3 - Alpha
            // Development Status :: 4 - Beta
            // Development Status :: 5 - Production/Stable
            // Development Status :: 6 - Mature
            // Development Status :: 7 - Inactive

            if (!\str_starts_with($classifier, 'Development Status ::')) {
                return null;
            }

            return \trim(\explode('-', \explode(' :: ', $classifier)[1])[1]);
        })->filter()->first();

        return [
            'stability' => $stability,
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'stability',
            'message' => \str_replace('Production/Stable', 'stable', $properties['stability']),
            'messageColor' => DetermineColorByVersion::execute($properties['stability']),
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
            '/pypi/stability/black' => 'stability',
            '/pypi/stability/plone.volto' => 'stability',
        ];
    }
}
