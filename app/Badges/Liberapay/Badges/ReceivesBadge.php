<?php

declare(strict_types=1);

namespace App\Badges\Liberapay\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use PreemStudio\Formatter\FormatMoney;

final class ReceivesBadge extends AbstractBadge
{
    protected array $routes = [
        '/liberapay/receives/{username}',
    ];

    protected array $keywords = [
        Category::FUNDING,
    ];

    public function handle(string $username): array
    {
        return $this->client->get($username)['receiving'];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'receives',
            'message' => FormatMoney::execute((float) $properties['amount'], $properties['currency']).'/week',
            'messageColor' => 'yellow.600',
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'receiving',
                path: '/liberapay/receives/GIMP',
                data: $this->render(['amount' => 0, 'currency' => 'EUR']),
            ),
        ];
    }
}
