<?php

declare(strict_types=1);

namespace App\Badges\DUB\Badges;

use App\Badges\AbstractBadge;
use App\Badges\DUB\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatStars;

final class StarsBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $package): array
    {
        $score = $this->client->get("{$package}/stats")['score'];

        return [
            'label'        => 'stars',
            'message'      => FormatStars::execute($score),
            'messageColor' => 'green.600',
        ];
    }

    public function service(): string
    {
        return 'DUB';
    }

    public function title(): string
    {
        return '';
    }

    public function keywords(): array
    {
        return [Category::RATING];
    }

    public function routePaths(): array
    {
        return [
            '/dub/stars/{package}',
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
            '/dub/stars/silly' => 'stars',
        ];
    }
}
