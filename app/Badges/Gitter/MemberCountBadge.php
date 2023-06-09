<?php

declare(strict_types=1);

namespace App\Badges\Gitter;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use BombenProdukt\Formatter\FormatNumber;

final class MemberCountBadge extends AbstractBadge
{
    protected string $route = '/gitter/members/{org}/{room}';

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
            'message' => FormatNumber::execute((float) $properties['count']),
            'messageColor' => 'ed1965',
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'members',
                path: '/gitter/members/redom/lobby',
                data: $this->render(['count' => '100']),
                deprecated: true,
            ),
            new BadgePreviewData(
                name: 'members',
                path: '/gitter/members/redom/redom',
                data: $this->render(['count' => '100']),
                deprecated: true,
            ),
        ];
    }
}
