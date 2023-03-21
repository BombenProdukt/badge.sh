<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Badges\AbstractBadge;
use App\Badges\GitHub\Client;
use App\Badges\Templates\VersionTemplate;
use GrahamCampbell\GitHub\Facades\GitHub;
use Illuminate\Routing\Route;
use Spatie\Regex\Regex;

final class GoModBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $owner, string $repo): array
    {
        $response = base64_decode(GitHub::repos()->contents()->show($owner, $repo, 'src/go.mod')['content']);

        return VersionTemplate::make('go', Regex::match('/go (.+)/', $response)->group(1));
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
            '/github/gomod/{owner}/{repo}',
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
            '/github/gomod/golang/go' => 'lerna',

        ];
    }
}
