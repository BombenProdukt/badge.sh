<?php

declare(strict_types=1);

namespace App\Badges\CocoaPods;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected string $route = '/cocoapods/version/{pod}';

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $pod): array
    {
        return $this->client->get($pod);
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
                path: '/cocoapods/version/AFNetworking',
                data: $this->render(['version' => '1.0.0']),
            ),
        ];
    }
}
