<?php

declare(strict_types=1);

namespace App\Badges\OpenCollective\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class BackersBadge extends AbstractBadge
{
    public function handle(string $slug, ?string $tierId = null): array
    {
        $response = $this->client->fetchCollectiveBackersCount($slug, 'users', $tierId);

        return [
            'label'        => 'backers',
            'message'      => FormatNumber::execute($response),
            'messageColor' => 'green.600',
        ];
    }

    public function keywords(): array
    {
        return [Category::FUNDING];
    }

    public function routePaths(): array
    {
        return [
            '/opencollective/backers/{slug}/{tierId?}',
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
            '/opencollective/backers/webpack' => 'backers',
        ];
    }
}
