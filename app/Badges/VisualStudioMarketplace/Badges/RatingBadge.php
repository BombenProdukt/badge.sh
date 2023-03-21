<?php

declare(strict_types=1);

namespace App\Badges\VisualStudioMarketplace\Badges;

use App\Badges\AbstractBadge;
use App\Badges\VisualStudioMarketplace\Client;
use Illuminate\Routing\Route;

final class RatingBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $extension): array
    {
        $response      = collect($this->client->get($extension));
        $averageRating = collect($response['statistics'])->firstWhere('statisticName', 'averagerating')['value'];
        $ratingCount   = collect($response['statistics'])->firstWhere('statisticName', 'ratingcount')['value'];

        return [
            'label'        => 'rating',
            'message'      => number_format($averageRating)."/5 ({$ratingCount})",
            'messageColor' => 'green.600',
        ];
    }

    public function service(): string
    {
        return 'Visual Studio Marketplace';
    }

    public function title(): string
    {
        return '';
    }

    public function keywords(): array
    {
        return [];
    }

    public function routePaths(): array
    {
        return [
            '/vs-marketplace/rating/{extension}',
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
            '/vs-marketplace/rating/vscodevim.vim' => 'rating',
        ];
    }
}
