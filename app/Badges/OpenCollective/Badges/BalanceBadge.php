<?php

declare(strict_types=1);

namespace App\Badges\OpenCollective\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class BalanceBadge extends AbstractBadge
{
    protected string $route = '/opencollective/balance/{slug}';

    protected array $keywords = [
        Category::FUNDING,
    ];

    public function handle(string $slug): array
    {
        $response = $this->client->get($slug);

        return [
            'amount' => $response['balance'] / 100,
            'currency' => $response['currency'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderMoney('balance', $properties['amount'], $properties['currency']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'balance',
                path: '/opencollective/balance/webpack',
                data: $this->render(['amount' => 1, 'currency' => 'USD']),
            ),
        ];
    }
}
