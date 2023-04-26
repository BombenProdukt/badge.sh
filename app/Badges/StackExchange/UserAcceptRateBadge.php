<?php

declare(strict_types=1);

namespace App\Badges\StackExchange;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class UserAcceptRateBadge extends AbstractBadge
{
    protected string $route = '/stack-exchange/user/accept-rate/{site}/{query}';

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $site, string $query): array
    {
        return [
            'rate' => $this->client->user($site, $query)['accept_rate'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderPercentage('accept rate', $properties['rate']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'accept rate',
                path: '/stack-exchange/user/accept-rate/stackoverflow/123',
                data: $this->render(['rate' => '100']),
            ),
        ];
    }
}
