<?php

declare(strict_types=1);

namespace App\Badges\OpenCollective;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use PreemStudio\Formatter\FormatMoney;

final class YearlyBadge extends AbstractBadge
{
    protected string $route = '/opencollective/yearly/{slug}';

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

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'yearly income',
                path: '/opencollective/yearly/webpack',
                data: $this->render([
                    'amount' => '1000000',
                    'currency' => 'USD',
                ]),
            ),
        ];
    }
}
