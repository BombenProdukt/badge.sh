<?php

declare(strict_types=1);

namespace App\Badges\Static\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class StaticBadge extends AbstractBadge
{
    protected array $routes = [
        '/static/{label}/{message}/{messageColor?}',
    ];

    protected array $keywords = [
        Category::OTHER,
    ];

    public function handle(string $label, string $message, ?string $messageColor = 'green.600'): array
    {
        return [
            'label' => $label,
            'message' => $message,
            'messageColor' => $messageColor,
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'swift version',
                path: '/static/Swift/4.2/orange',
                data: $this->render([
                    'label' => 'Swift',
                    'message' => '4.2',
                    'messageColor' => 'orange.600',
                ]),
            ),
            new BadgePreviewData(
                name: 'license MIT',
                path: '/static/license/MIT/blue',
                data: $this->render([
                    'label' => 'license',
                    'message' => 'MIT',
                    'messageColor' => 'blue.600',
                ]),
            ),
            new BadgePreviewData(
                name: 'chat on gitter',
                path: '/static/chat/on%20gitter/cyan',
                data: $this->render([
                    'label' => 'chat',
                    'message' => 'on%20gitter',
                    'messageColor' => 'cyan.600',
                ]),
            ),
            new BadgePreviewData(
                name: 'star rating',
                path: '/static/stars/★★★★☆',
                data: $this->render([
                    'label' => 'stars',
                    'message' => '★★★★☆',
                ]),
            ),
            new BadgePreviewData(
                name: 'patron',
                path: '/static/become/a%20patron/F96854',
                data: $this->render([
                    'label' => 'become',
                    'message' => 'a%20patron',
                    'messageColor' => 'F96854',
                ]),
            ),
            new BadgePreviewData(
                name: 'code style: standard',
                path: '/static/code%20style/standard/f2a',
                data: $this->render([
                    'label' => 'code%20style',
                    'message' => 'standard',
                    'messageColor' => 'f2a',
                ]),
            ),
        ];
    }
}
