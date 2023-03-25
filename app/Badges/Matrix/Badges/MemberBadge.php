<?php

declare(strict_types=1);

namespace App\Badges\Matrix\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;
use Illuminate\Support\Str;
use PreemStudio\Formatter\FormatNumber;

final class MemberBadge extends AbstractBadge
{
    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $room, string $server = 'matrix.org'): array
    {
        return [
            'room' => $room,
            'server' => $server,
            'count' => $this->client->fetchMembersCount($room, $server),
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => '#'.$properties['room'].':'.$properties['server'],
            'message' => FormatNumber::execute($properties['count']).' '.Str::plural('member', $properties['count']),
            'messageColor' => 'blue.600',
        ];
    }

    public function routePaths(): array
    {
        return [
            '/matrix/members/{room}/gitter',
            '/matrix/members/{room}/gitter.im',
            '/matrix/members/{room}/{server?}',
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
            '/matrix/members/rust/matrix.org' => 'members',
            '/matrix/members/thisweekinmatrix' => 'members',
            '/matrix/members/archlinux/archlinux.org' => 'members',
        ];
    }
}
