<?php

declare(strict_types=1);

namespace App\Badges\Gitter\Badges;

use App\Badges\Gitter\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

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
            'label'        => 'gitter',
            'message'      => FormatNumber::execute((float) $matches[1][0]),
            'messageColor' => 'ed1965',
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
            '/gitter/{org}/{room}/members',
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
            '/gitter/redom/lobby/members' => 'members',
            '/gitter/redom/redom/members' => 'members',
        ];
    }

    public function deprecated(): array
    {
        return [
            '2023-03-18' => 'Deprecated due to the deprecation of required APIs.',
        ];
    }
}
