<?php

declare(strict_types=1);

namespace App\Badges\Discord\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class MembersBadge extends AbstractBadge
{
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
            'message' => FormatNumber::execute($properties['count']).' members',
            'messageColor' => '7289DA',
        ];
    }

    public function keywords(): array
    {
        return [Category::SOCIAL];
    }

    public function routePaths(): array
    {
        return [
            '/discord/members/{inviteCode}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/discord/members/reactiflux' => 'members',
        ];
    }
}
