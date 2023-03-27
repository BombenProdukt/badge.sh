<?php

declare(strict_types=1);

namespace App\Badges\Reddit\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use PreemStudio\Formatter\FormatNumber;

final class PostKarmaBadge extends AbstractBadge
{
    protected string $route = '/reddit/post-karma/{user}';

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $user): array
    {
        return [
            'username' => $user,
            'karma' => $this->client->get("user/{$user}/about.json")['link_karma'],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'u/'.$properties['username'],
            'message' => FormatNumber::execute((float) $properties['karma']).' post karma',
            'messageColor' => 'ff4500',
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'post karma',
                path: '/reddit/post-karma/spez',
                data: $this->render(['username' => 'spez', 'karma' => 0]),
            ),
        ];
    }
}
