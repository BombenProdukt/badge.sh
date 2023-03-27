<?php

declare(strict_types=1);

namespace App\Badges\RubyGems\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class PlatformBadge extends AbstractBadge
{
    protected string $route = '/rubygems/platform/{gem}';

    protected array $keywords = [
        Category::PLATFORM_SUPPORT,
    ];

    public function handle(string $gem): array
    {
        return $this->client->get("gems/{$gem}");
    }

    public function render(array $properties): array
    {
        return $this->renderText('platform', $properties['platform']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'platform',
                path: '/rubygems/platform/rails',
                data: $this->render(['platform' => 'ruby']),
            ),
        ];
    }
}
