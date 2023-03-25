<?php

declare(strict_types=1);

namespace App\Badges\OpenCollective\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatMoney;

final class YearlyBadge extends AbstractBadge
{
    public function handle(string $slug, ?string $tier = null): array
    {
        $response = $this->client->get($slug, null, $tier);

        return [
            'amount' => $response['yearlyIncome'],
            'currency' => $response['currency'],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'yearly income',
            'message' => FormatMoney::execute($properties['amount'] / 100, $properties['currency']),
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
            '/opencollective/yearly/{slug}',
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
            '/opencollective/yearly/webpack' => 'yearly income',
        ];
    }
}
