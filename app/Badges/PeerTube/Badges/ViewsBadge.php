<?php

declare(strict_types=1);

namespace App\Badges\PeerTube\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class ViewsBadge extends AbstractBadge
{
    public function handle(string $instance, string $video): array
    {
        $response = $this->client->get($instance, "videos/{$video}");

        return [
            'label'        => 'views',
            'message'      => FormatNumber::execute($response['views']),
            'messageColor' => 'F1680D',
        ];
    }

    public function keywords(): array
    {
        return [Category::SOCIAL];
    }

    public function routePaths(): array
    {
        return [
            '/peertube/views/{instance}/{video}',
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
            '/peertube/views/framatube.org/9c9de5e8-0a1e-484a-b099-e80766180a6d' => 'views',
        ];
    }
}
