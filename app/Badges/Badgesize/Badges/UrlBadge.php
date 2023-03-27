<?php

declare(strict_types=1);

namespace App\Badges\Badgesize\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class UrlBadge extends AbstractBadge
{
    protected string $route = '/badgesize/{compression:brotli,gzip,normal}/{path:wildcard}';

    protected array $keywords = [
        Category::SIZE,
    ];

    public function handle(string $compression, string $path): array
    {
        $response = $this->client->get($compression, 'https:/'.\str_replace(['https://', 'https/'], '', $path));

        return [
            'color' => $response['color'],
            'compression' => $compression,
            'size' => $response['prettySize'],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => $properties['compression'] === 'normal' ? 'size' : $properties['compression'].' size',
            'message' => $properties['size'],
            'messageColor' => $properties['color'],
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'arbitrary url',
                path: '/badgesize/normal/file-url/https/unpkg.com/snarkdown/dist/snarkdown.js',
                data: $this->render(['compression' => 'normal', 'size' => '7.03 kB', 'color' => '3487CE']),
            ),
            new BadgePreviewData(
                name: 'arbitrary url',
                path: '/badgesize/normal/file-url/unpkg.com/snarkdown/dist/snarkdown.js',
                data: $this->render(['compression' => 'normal', 'size' => '7.03 kB', 'color' => '3487CE']),
            ),
        ];
    }
}
