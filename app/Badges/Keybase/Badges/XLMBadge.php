<?php

declare(strict_types=1);

namespace App\Badges\Keybase\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class XLMBadge extends AbstractBadge
{
    public function handle(string $address): array
    {
        $response = $this->client->get($address, 'stellar');

        return [
            'label'        => 'XLM',
            'message'      => $response['them']['stellar']['primary']['account_id'],
            'messageColor' => 'blue.600',
        ];
    }

    public function keywords(): array
    {
        return [Category::SOCIAL];
    }

    public function routePaths(): array
    {
        return [
            '/keybase/xlm/{address}',
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
            '/keybase/xlm/skyplabs' => 'xlm address',
        ];
    }
}
