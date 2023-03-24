<?php

declare(strict_types=1);

namespace App\Badges\VisualStudioAppCenter\Badges;

use App\Badges\AbstractBadge;
use App\Badges\VisualStudioAppCenter\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class ReleaseSizeBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $owner, string $app, string $token): array
    {
        return $this->renderSize($this->client->releases($owner, $app, $token)['size']);
    }

    public function service(): string
    {
        return 'Visual Studio App Center';
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/visual-studio-app-center/size/{owner}/{app}/{token}',
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
            '/visual-studio-app-center/size/jct/my-amazing-app/ac70cv...' => 'size',
        ];
    }
}