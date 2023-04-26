<?php

declare(strict_types=1);

namespace App\Badges\CocoaPods;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class LicenseBadge extends AbstractBadge
{
    protected string $route = '/cocoapods/license/{pod}';

    protected array $keywords = [
        Category::LICENSE,
    ];

    public function handle(string $pod): array
    {
        $response = $this->client->get($pod);

        return [
            'license' => \is_array($response['license']) ? $response['license']['type'] : $response['license'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderLicense($properties['license']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'license',
                path: '/cocoapods/license/AFNetworking',
                data: $this->render(['license' => 'MIT']),
            ),
        ];
    }
}
