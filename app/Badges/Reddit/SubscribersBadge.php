<?php

declare(strict_types=1);

namespace App\Badges\Reddit;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use BombenProdukt\Formatter\FormatNumber;

final class SubscribersBadge extends AbstractBadge
{
    protected string $route = '/reddit/subscribers/{subreddit}';

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $subreddit): array
    {
        return [
            'subreddit' => $subreddit,
            'subscribers' => $this->client->get("r/{$subreddit}/about.json")['subscribers'],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'r/'.$properties['subreddit'],
            'message' => FormatNumber::execute((float) $properties['subscribers']).' subscribers',
            'messageColor' => 'ff4500',
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'subreddit subscribers',
                path: '/reddit/subscribers/programming',
                data: $this->render(['subreddit' => 'programming', 'subscribers' => '123456']),
            ),
        ];
    }
}
