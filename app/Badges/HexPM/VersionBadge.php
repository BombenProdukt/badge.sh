<?php

declare(strict_types=1);

namespace App\Badges\HexPM;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected string $route = '/hex/version/{packageName}';

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $packageName): array
    {
        $response = $this->client->get($packageName);

        return [
            'version' => $response['latest_stable_version'] ?? $response['latest_version'],
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
                path: '/hex/version/plug',
                data: $this->render(['version' => '1.0.0']),
            ),
        ];
    }
}
