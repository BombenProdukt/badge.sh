<?php

declare(strict_types=1);

namespace App\Badges\Liberapay\Badges;

use App\Enums\Category;
use PreemStudio\Formatter\FormatMoney;

final class GivesBadge extends AbstractBadge
{
    protected array $routes = [
        '/liberapay/gives/{username}',
    ];

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
            '/liberapay/gives/aurelienpierre' => 'giving',
        ];
    }
}
