<?php

declare(strict_types=1);

namespace App\Badges\OpenCollective\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class BalanceBadge extends AbstractBadge
{
    public function handle(string $slug): array
    {
        $response = $this->client->get($slug);

        return [
            'amount'   => $response['balance'] / 100,
            'currency' => $response['currency'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderMoney('balance', $properties['amount'], $properties['currency']);
    }

    public function keywords(): array
    {
        return [Category::FUNDING];
    }

    public function routePaths(): array
    {
        return [
            '/opencollective/balance/{slug}',
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
            '/opencollective/balance/webpack' => 'balance',
        ];
    }
}
