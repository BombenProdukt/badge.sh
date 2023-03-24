<?php

declare(strict_types=1);

namespace App\Badges\Liberapay\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatMoney;

final class GivesBadge extends AbstractBadge
{
    public function handle(string $username): array
    {
        return $this->client->get($username)['giving'];
    }

    public function render(array $properties): array
    {
        return [
            'label'        => 'gives',
            'message'      => FormatMoney::execute((float) $properties['amount'], $properties['currency']).'/week',
            'messageColor' => 'yellow.600',
        ];
    }

    public function keywords(): array
    {
        return [Category::FUNDING];
    }

    public function routePaths(): array
    {
        return [
            '/liberapay/gives/{username}',
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
            '/liberapay/gives/aurelienpierre' => 'giving',
        ];
    }
}
