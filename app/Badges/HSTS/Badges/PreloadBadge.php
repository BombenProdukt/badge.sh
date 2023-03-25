<?php

declare(strict_types=1);

namespace App\Badges\HSTS\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class PreloadBadge extends AbstractBadge
{
    protected array $routes = [
        '/hsts/preload/{domain}',
    ];

    protected array $keywords = [
        Category::MONITORING,
    ];

    public function handle(string $domain): array
    {
        return [
            'status' => $this->client->status($domain),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderStatus('hsts preloaded', $properties['status']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'status',
                path: '/hsts/preload/github.com',
                data: $this->render([]),
            ),
        ];
    }
}
