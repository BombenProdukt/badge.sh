<?php

declare(strict_types=1);

namespace App\Badges\PeerTube;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use BombenProdukt\Formatter\FormatNumber;

final class DislikesBadge extends AbstractBadge
{
    protected string $route = '/peertube/dislikes/{instance}/{video}';

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $instance, string $video): array
    {
        return $this->client->get($instance, "videos/{$video}");
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'votes',
            'message' => FormatNumber::execute((float) $properties['dislikes']),
            'messageColor' => 'F1680D',
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'dislikes',
                path: '/peertube/dislikes/framatube.org/9c9de5e8-0a1e-484a-b099-e80766180a6d',
                data: $this->render(['dislikes' => '1000']),
            ),
        ];
    }
}
