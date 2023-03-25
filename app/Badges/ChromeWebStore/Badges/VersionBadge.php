<?php

declare(strict_types=1);

namespace App\Badges\ChromeWebStore\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected array $routes = [
        '/chrome-web-store/version/{itemId}',
    ];

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $itemId): array
    {
        \preg_match('|<span class="C-b-p-D-Xe h-C-b-p-D-md">(.*?)</span>|', $this->client->get($itemId), $matches);

        return [
            'version' => $matches[1],
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
                path: '/chrome-web-store/version/ckkdlimhmcjmikdlpkmbgfkaikojcbjk',
                data: $this->render([]),
            ),
        ];
    }
}
