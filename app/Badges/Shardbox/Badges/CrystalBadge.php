<?php

declare(strict_types=1);

namespace App\Badges\Shardbox\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class CrystalBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/shardbox/crystal-version/{shard}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::PLATFORM_SUPPORT,
    ];

    public function handle(string $shard): array
    {
        \preg_match('/Crystal<\\/span>\\s*<span[^>]*?>([^<]+)<\\//i', $this->client->get($shard), $matches);

        return [
            'version' => $matches[1],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'crystal',
            'message' => \html_entity_decode($properties['version']),
            'messageColor' => 'green.600',
        ];
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
            '/shardbox/crystal-version/amber' => 'crystal version',
        ];
    }
}
