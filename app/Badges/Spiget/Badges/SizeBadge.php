<?php

declare(strict_types=1);

namespace App\Badges\Spiget\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Spiget\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class SizeBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $resourceId): array
    {
        $file = $this->client->resource($resourceId)['file'];

        if ($file['type'] === 'external') {
            return $this->renderText('size', 'resource hosted externally', 'gray.600');
        }

        return $this->renderText('size', $file['size'].' '.$file['sizeUnit']);
    }

    public function service(): string
    {
        return 'Spiget';
    }

    public function keywords(): array
    {
        return [Category::SIZE];
    }

    public function routePaths(): array
    {
        return [
            '/spiget/size/{resourceId}',
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
            '/spiget/size/9089' => 'size',
        ];
    }
}
