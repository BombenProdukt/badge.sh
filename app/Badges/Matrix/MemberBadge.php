<?php

declare(strict_types=1);

namespace App\Badges\Matrix;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Illuminate\Support\Str;
use BombenProdukt\Formatter\FormatNumber;

final class MemberBadge extends AbstractBadge
{
    protected string $route = '/matrix/members/{room}/{server?}';

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
            'message' => FormatNumber::execute((float) $properties['count']).' '.Str::plural('member', $properties['count']),
            'messageColor' => 'blue.600',
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'members',
                path: '/matrix/members/rust/matrix.org',
                data: $this->render(['room' => 'rust', 'server' => 'matrix.org', 'count' => '1000']),
            ),
            new BadgePreviewData(
                name: 'members',
                path: '/matrix/members/thisweekinmatrix',
                data: $this->render(['room' => 'thisweekinmatrix', 'server' => 'matrix.org', 'count' => '1000']),
            ),
            new BadgePreviewData(
                name: 'members',
                path: '/matrix/members/archlinux/archlinux.org',
                data: $this->render(['room' => 'archlinux', 'server' => 'archlinux.org', 'count' => '1000']),
            ),
        ];
    }
}
