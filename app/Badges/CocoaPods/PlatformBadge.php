<?php

declare(strict_types=1);

namespace App\Badges\CocoaPods;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class PlatformBadge extends AbstractBadge
{
    protected string $route = '/cocoapods/platform/{pod}';

    protected array $keywords = [
        Category::PLATFORM_SUPPORT,
    ];

    public function handle(string $pod): array
    {
        return [
            'platforms' => \array_keys($this->client->get($pod)['platforms']),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderText('platforms', \implode(' | ', $properties['platforms']), 'blue.600');
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'platform',
                path: '/cocoapods/platform/AFNetworking',
                data: $this->render(['platforms' => ['iOS', 'OS X', 'watchOS', 'tvOS']]),
            ),
        ];
    }
}
