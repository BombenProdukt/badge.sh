<?php

declare(strict_types=1);

namespace App\Badges\Conda\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class PlatformBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/conda/platform/{channel}/{package}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::PLATFORM_SUPPORT,
    ];

    public function handle(string $channel, string $package): array
    {
        return [
            'platforms' => $this->client->get($channel, $package)['conda_platforms'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderText('platforms', \implode(' | ', $properties['platforms']), 'blue.600');
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
            '/conda/platform/conda-forge/python' => 'platform',
        ];
    }
}
