<?php

declare(strict_types=1);

namespace App\Badges\Discord\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Discord\Client;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class MembersBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $inviteCode): array
    {
        $response = $this->client->get($inviteCode);

        return [
            'label'        => $response['guild']['name'] ?? 'discord',
            'message'      => FormatNumber::execute($response['approximate_member_count']).' members',
            'messageColor' => '7289DA',
        ];
    }

    public function service(): string
    {
        return 'Discord';
    }

    public function title(): string
    {
        return '';
    }

    public function keywords(): array
    {
        return [];
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
