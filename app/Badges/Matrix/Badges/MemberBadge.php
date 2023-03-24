<?php

declare(strict_types=1);

namespace App\Badges\Matrix\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;
use Illuminate\Support\Str;
use PreemStudio\Formatter\FormatNumber;

final class MemberBadge extends AbstractBadge
{
    public function handle(string $room, string $server = 'matrix.org'): array
    {
        $count = $this->client->fetchMembersCount($room, $server);

        return [
            'label'        => "#{$room}:{$server}",
            'message'      => FormatNumber::execute($count).' '.Str::plural('member', $count),
            'messageColor' => 'blue.600',
        ];
    }

    public function keywords(): array
    {
        return [Category::SOCIAL];
    }

    public function routePaths(): array
    {
        return [
            '/matrix/members/{room}/gitter',
            '/matrix/members/{room}/gitter.im',
            '/matrix/members/{room}/{server?}',
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
            '/matrix/members/rust/matrix.org'         => 'members',
            '/matrix/members/thisweekinmatrix'        => 'members',
            '/matrix/members/archlinux/archlinux.org' => 'members',
        ];
    }
}
