<?php

declare(strict_types=1);

namespace App\Badges\Liberapay\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatMoney;

final class GivesBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/liberapay/gives/{username}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
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
            '/liberapay/gives/aurelienpierre' => 'giving',
        ];
    }
}
