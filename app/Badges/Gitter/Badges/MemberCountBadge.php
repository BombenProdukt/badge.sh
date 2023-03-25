<?php

declare(strict_types=1);

namespace App\Badges\Gitter\Badges;

use App\Enums\Category;
use PreemStudio\Formatter\FormatNumber;

final class MemberCountBadge extends AbstractBadge
{
    protected array $routes = [
        '/gitter/members/{org}/{room}',
    ];

    protected array $keywords = [
        Category::SOCIAL,
    ];

    protected array $deprecated = [
        '2023-03-18' => 'Deprecated due to the deprecation of required APIs.',
    ];

    public function handle(string $org, string $room): array
    {
        \preg_match('/"userCount"\s*:\s*(\d+)/', $this->client->get($org, $room), $matches);

        return [
            'count' => $matches[1][0],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'gitter',
            'message' => FormatNumber::execute($properties['count']),
            'messageColor' => 'ed1965',
        ];
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/gitter/members/redom/lobby' => 'members',
            '/gitter/members/redom/redom' => 'members',
        ];
    }
}
