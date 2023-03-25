<?php

declare(strict_types=1);

namespace App\Badges\Matrix\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Illuminate\Support\Str;
use PreemStudio\Formatter\FormatNumber;

final class MemberBadge extends AbstractBadge
{
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

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'members',
                path: '/matrix/members/rust/matrix.org',
                data: $this->render([]),
            ),
            new BadgePreviewData(
                name: 'members',
                path: '/matrix/members/thisweekinmatrix',
                data: $this->render([]),
            ),
            new BadgePreviewData(
                name: 'members',
                path: '/matrix/members/archlinux/archlinux.org',
                data: $this->render([]),
            ),
        ];
    }
}
