<?php

declare(strict_types=1);

namespace App\Badges\PeerTube;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use BombenProdukt\Formatter\FormatNumber;

final class VotesBadge extends AbstractBadge
{
    protected string $route = '/peertube/votes/{instance}/{video}';

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
            'message' => \sprintf('%s 👍 %s 👎', FormatNumber::execute((float) $properties['likes']), FormatNumber::execute((float) $properties['dislikes'])),
            'messageColor' => 'F1680D',
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'votes',
                path: '/peertube/votes/framatube.org/9c9de5e8-0a1e-484a-b099-e80766180a6d',
                data: $this->render(['likes' => '1000000', 'dislikes' => '1000000']),
            ),
        ];
    }
}
