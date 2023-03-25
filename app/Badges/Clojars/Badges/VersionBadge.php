<?php

declare(strict_types=1);

namespace App\Badges\Clojars\Badges;

use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected array $routes = [
        '/clojars/version/{clojar}',
    ];

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $clojar): array
    {
        $response = $this->client->get($clojar);

        return [
            'version' => $response['latest_release'] ?? $response['latest_version'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version']);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/clojars/version/prismic' => 'version',
        ];
    }
}
