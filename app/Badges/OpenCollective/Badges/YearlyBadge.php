<?php

declare(strict_types=1);

namespace App\Badges\OpenCollective\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatMoney;

final class YearlyBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/opencollective/yearly/{slug}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::FUNDING,
    ];

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
