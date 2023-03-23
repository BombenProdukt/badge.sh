<?php

declare(strict_types=1);

namespace App\Badges\Steam\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Steam\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class FileViewsBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $fileId): array
    {
        return $this->renderNumber('views', $this->client->file($fileId)['views']);
    }

    public function service(): string
    {
        return 'Steam';
    }

    public function keywords(): array
    {
        return [Category::SOCIAL];
    }

    public function routePaths(): array
    {
        return [
            '/steam/file-views/{fileId}',
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
            '/steam/file-views/100' => 'file views',
        ];
    }
}
