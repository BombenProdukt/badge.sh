<?php

declare(strict_types=1);

namespace App\Badges\Bower;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected string $route = '/bower/version/{packageName}/{channel?}';

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
            new BadgePreviewData(
                name: 'version',
                path: '/bower/version/bootstrap',
                data: $this->render(['version' => '1.0.0']),
            ),
        ];
    }
}
