<?php

declare(strict_types=1);

namespace App\Badges\Bower\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class VersionBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/bower/version/{packageName}/{channel?}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $packageName, ?string $channel = 'latest'): array
    {
        $response = $this->client->get($packageName);

        return [
            'version' => $response[$channel === 'latest' ? 'latest_stable_release_number' : 'latest_release_number'] ?? $response['latest_release_number'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version']);
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
            '/bower/version/bootstrap' => 'version',
        ];
    }
}
