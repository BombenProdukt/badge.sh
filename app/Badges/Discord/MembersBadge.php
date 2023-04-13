<?php

declare(strict_types=1);

namespace App\Badges\Discord;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use PreemStudio\Formatter\FormatNumber;

final class MembersBadge extends AbstractBadge
{
    protected string $route = '/discord/members/{inviteCode}';

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $inviteCode): array
    {
        return [
            'count' => $this->client->get($inviteCode)['approximate_member_count'],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => $response['guild']['name'] ?? 'discord',
            'message' => FormatNumber::execute((float) $properties['count']).' members',
            'messageColor' => '7289DA',
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'members',
                path: '/discord/members/reactiflux',
                data: $this->render(['count' => '100']),
            ),
        ];
    }
}
