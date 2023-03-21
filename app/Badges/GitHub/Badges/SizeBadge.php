<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Badges\AbstractBadge;
use App\Badges\GitHub\Client;
use GrahamCampbell\GitHub\Facades\GitHub;
use Illuminate\Routing\Route;

final class SizeBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $owner, string $repo): array
    {
        return $this->renderSize(GitHub::connection()->repos()->show($owner, $repo)['size']);
    }

    public function service(): string
    {
        return 'GitHub';
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
            '/github/size/{owner}/{repo}',
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
            '/github/size/micromatch/micromatch' => 'size',

        ];
    }
}
