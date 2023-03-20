<?php

declare(strict_types=1);

namespace App\Badges\VisualStudioMarketplace\Badges;

use App\Badges\VisualStudioMarketplace\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class RatingBadge implements Badge
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
        return [
            //
        ];
    }

    public function routePaths(): array
    {
        return [
            '/vs-marketplace/{extension}/rating',
        ];
    }

    public function routeParameters(): array
    {
        return [
            //
        ];
    }

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPreviews(): array
    {
        return [
            //
        ];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/vs-marketplace/vscodevim.vim/rating' => 'rating',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}