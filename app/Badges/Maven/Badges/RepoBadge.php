<?php

declare(strict_types=1);

namespace App\Badges\Maven\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Maven\Client;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class RepoBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $repo, string $group, string $artifact): array
    {
        $response = $this->client->get($repo, str_replace('.', '/', $group)."/{$artifact}/maven-metadata.xml");

        preg_match('/<latest>(?<version>.+)<\/latest>/', $response, $matches);

        return $this->renderVersion($this->service(), $matches[1]);
    }

    public function service(): string
    {
        return 'Maven';
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
            '/maven/version/{repo}/{group}/{artifact}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->whereIn('repo', ['maven-central', 'jcenter']);
        $route->where('pathname', RoutePattern::CATCH_ALL->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/maven/version/maven-central/com.google.code.gson/gson' => 'version (maven-central)',
            '/maven/version/jcenter/com.squareup.okhttp3/okhttp'     => 'version (jcenter)',
        ];
    }
}
