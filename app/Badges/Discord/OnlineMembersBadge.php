<?php

declare(strict_types=1);

namespace App\Badges\Discord;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use PreemStudio\Formatter\FormatNumber;

final class OnlineMembersBadge extends AbstractBadge
{
    protected string $route = '/discord/online-members/{inviteCode}';

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $inviteCode): array
    {
        return [
            'count' => $this->client->get($inviteCode)['approximate_presence_count'],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => $response['guild']['name'] ?? 'discord',
            'message' => FormatNumber::execute((float) $properties['count']).' online',
            'messageColor' => '7289DA',
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'online members',
                path: '/discord/online-members/8Jzqu3T',
                data: $this->render(['count' => '100']),
            ),
        ];
    }
}
