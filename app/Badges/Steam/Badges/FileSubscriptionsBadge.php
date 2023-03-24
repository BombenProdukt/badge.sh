<?php

declare(strict_types=1);

namespace App\Badges\Steam\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class FileSubscriptionsBadge extends AbstractBadge
{
    public function handle(string $fileId): array
    {
        return $this->renderNumber('subscriptions', $this->client->file($fileId)['subscriptions']);
    }

    public function keywords(): array
    {
        return [Category::SOCIAL];
    }

    public function routePaths(): array
    {
        return [
            '/steam/file-subscriptions/{fileId}',
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
            '/steam/file-subscriptions/100' => 'file subscriptions',
        ];
    }
}
