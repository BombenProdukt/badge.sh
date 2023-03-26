<?php

declare(strict_types=1);

namespace App\Badges\Packagist\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class LanguageBadge extends AbstractBadge
{
    protected array $routes = [
        '/packagist/language/{package:packageWithVendorOnly}',
    ];

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $package, ?string $channel = null): array
    {
        return $this->client->get($package);
    }

    public function render(array $properties): array
    {
        return $this->renderText('language', $properties['language']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'language',
                path: '/packagist/language/monolog/monolog',
                data: $this->render(['language' => 'PHP']),
            ),
        ];
    }
}
