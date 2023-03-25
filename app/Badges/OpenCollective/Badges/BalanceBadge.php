<?php

declare(strict_types=1);

namespace App\Badges\OpenCollective\Badges;

use App\Enums\Category;

final class BalanceBadge extends AbstractBadge
{
    protected array $routes = [
        '/opencollective/balance/{slug}',
    ];

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

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/opencollective/balance/webpack' => 'balance',
        ];
    }
}
