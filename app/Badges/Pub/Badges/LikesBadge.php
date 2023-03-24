<?php

declare(strict_types=1);

namespace App\Badges\Pub\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class LikesBadge extends AbstractBadge
{
    public function handle(string $package): array
    {
        $likeCount = $this->client->api("packages/{$package}/score")['likeCount'];

        return [
            'label'        => 'popularity',
            'message'      => FormatNumber::execute($likeCount),
            'messageColor' => 'green.600',
        ];
    }

    public function keywords(): array
    {
        return [Category::SOCIAL];
    }

    public function routePaths(): array
    {
        return [
            '/pub/likes/{package}',
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
            '/pub/likes/firebase_core' => 'likes',
        ];
    }
}
