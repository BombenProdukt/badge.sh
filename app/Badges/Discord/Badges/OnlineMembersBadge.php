<?php

declare(strict_types=1);

namespace App\Badges\Discord\Badges;

use App\Badges\Discord\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class OnlineMembersBadge implements Badge
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
            'message'      => FormatNumber::execute($response['approximate_presence_count']).' online',
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
        return [
            //
        ];
    }

    public function routePaths(): array
    {
        return [
            '/discord/online-members/{inviteCode}',
        ];
    }

    public function routeParameters(): array
    {
        return [
            //
        ];
    }

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPreviews(): array
    {
        return [
            //
        ];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/discord/online-members/8Jzqu3T' => 'online members',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
