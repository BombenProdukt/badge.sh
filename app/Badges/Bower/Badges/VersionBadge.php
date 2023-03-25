<?php

declare(strict_types=1);

namespace App\Badges\Bower\Badges;

use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected array $routes = [
        '/bower/version/{packageName}/{channel?}',
    ];

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

    public function previews(): array
    {
        return [
            '/bower/version/bootstrap' => 'version',
        ];
    }
}
