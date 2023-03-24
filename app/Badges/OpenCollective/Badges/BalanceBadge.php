<?php

declare(strict_types=1);

namespace App\Badges\OpenCollective\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatMoney;

final class BalanceBadge extends AbstractBadge
{
    public function handle(string $slug): array
    {
        $response = $this->client->get($slug);

        return [
            'label'        => 'balance',
            'message'      => FormatMoney::execute($response['balance'] / 100, $response['currency']),
            'messageColor' => 'green.600',
        ];
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
