<?php

declare(strict_types=1);

namespace App\Badges\Reddit;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use BombenProdukt\Formatter\FormatNumber;

final class CommentKarmaBadge extends AbstractBadge
{
    protected string $route = '/reddit/comment-karma/{user}';

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $user): array
    {
        return [
            'username' => $user,
            'karma' => $this->client->get("user/{$user}/about.json")['comment_karma'],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'u/'.$properties['username'],
            'message' => FormatNumber::execute((float) $properties['karma']).' comment karma',
            'messageColor' => 'ff4500',
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'comment karma',
                path: '/reddit/comment-karma/spez',
                data: $this->render(['username' => 'spez', 'karma' => '1000000']),
            ),
        ];
    }
}
