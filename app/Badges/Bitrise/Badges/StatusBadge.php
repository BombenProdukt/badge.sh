<?php

declare(strict_types=1);

namespace App\Badges\Bitrise\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class StatusBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/bitrise/version/{token}/{appId}/{branch?}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::BUILD,
    ];

    public function handle(string $token, string $appId, ?string $branch = null): array
    {
        return $this->client->get($token, $appId, $branch);
    }

    public function render(array $properties): array
    {
        return $this->renderText('status', $properties['status'] === 'unknown' ? 'branch not found' : $properties['status'], [
            'error' => 'red.600',
            'success' => 'green.600',
            'unknown' => 'gray.600',
        ][$properties['status']]);
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
            '/bitrise/version/lESRN9rEFFfDq92JtXs_jw/3ff11fe8457bd304' => 'version',
            '/bitrise/version/lESRN9rEFFfDq92JtXs_jw/3ff11fe8457bd304/master' => 'version',
        ];
    }
}
