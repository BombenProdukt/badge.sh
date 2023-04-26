<?php

declare(strict_types=1);

namespace App\Badges\Liberapay;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use BombenProdukt\Formatter\FormatMoney;

final class GivesBadge extends AbstractBadge
{
    protected string $route = '/liberapay/gives/{username}';

    protected array $keywords = [
        Category::FUNDING,
    ];

    public function handle(string $username): array
    {
        return $this->client->get($username)['giving'];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'gives',
            'message' => FormatMoney::execute((float) $properties['amount'], $properties['currency']).'/week',
            'messageColor' => 'yellow.600',
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'giving',
                path: '/liberapay/gives/aurelienpierre',
                data: $this->render(['amount' => '10', 'currency' => 'EUR']),
            ),
        ];
    }
}
