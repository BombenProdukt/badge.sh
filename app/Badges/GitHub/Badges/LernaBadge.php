<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Enums\Category;
use GrahamCampbell\GitHub\Facades\GitHub;
use Illuminate\Routing\Route;

final class LernaBadge extends AbstractBadge
{
    public function handle(string $owner, string $repo): array
    {
        $response = json_decode(base64_decode(GitHub::repos()->contents()->show($owner, $repo, 'lerna.json')['content']), true, JSON_THROW_ON_ERROR);

        return $this->renderText('lerna', $response['version'], 'blue.600');
    }

    public function keywords(): array
    {
        return [Category::PLATFORM_SUPPORT, Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/github/lerna/{owner}/{repo}',
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
            '/github/lerna/lerna/lerna' => 'lerna',

        ];
    }
}
