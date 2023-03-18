<?php

declare(strict_types=1);

namespace App\Badges\Gitter\Badges;

use App\Actions\FormatNumber;
use App\Badges\Gitter\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class MemberCountBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $org, string $room): array
    {
        preg_match('/"userCount"\s*:\s*(\d+)/', $this->client->get($org, $room), $matches);

        return [
            'label'       => 'gitter',
            'status'      => FormatNumber::execute((float) $matches[1][0]),
            'statusColor' => 'ed1965',
        ];
    }

    public function service(): string
    {
        return 'Gitter';
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
            '/gitter/members/{org}/{room}',
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
            '/gitter/members/redom/lobby' => 'members',
            '/gitter/members/redom/redom' => 'members',
        ];
    }

    public function deprecated(): array
    {
        return [
            '2023-03-18' => 'Deprecated due to the deprecation of required APIs.',
        ];
    }
}
