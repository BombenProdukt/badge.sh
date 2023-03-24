<?php

declare(strict_types=1);

namespace App\Badges\OpenCollective\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class ContributorsBadge extends AbstractBadge
{
    public function handle(string $slug): array
    {
        $response = $this->client->get($slug);

        return [
            'label'        => 'contributors',
            'message'      => FormatNumber::execute($response['contributorsCount']),
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
            '/opencollective/contributors/{slug}',
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
            '/opencollective/contributors/webpack' => 'contributors',
        ];
    }
}
