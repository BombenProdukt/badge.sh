<?php

declare(strict_types=1);

namespace App\Badges\Discord\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class MembersBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/discord/members/{inviteCode}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
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
            'message' => FormatNumber::execute($properties['count']).' members',
            'messageColor' => '7289DA',
        ];
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
