<?php

declare(strict_types=1);

namespace App\Badges\Pub\Badges;

use App\Badges\Pub\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class DartPlatformBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $package): array
    {
        $pubScores = $this->client->api("packages/{$package}/metrics")['scorecard'];
        $sdk       = implode('|', $this->parseTags($pubScores['panaReport']['derivedTags'], 'sdk'));

        return [
            'label'       => 'dart',
            'status'      => $sdk ?? 'unknown',
            'statusColor' => $sdk ? 'blue.600' : 'gray.600',
        ];
    }

    public function service(): string
    {
        return 'Pub';
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
            '/pub/dart-platform/{package}',
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
            '/pub/dart-platform/rxdart'         => 'dart-platform',
            '/pub/dart-platform/google_sign_in' => 'dart-platform',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }

    private function parseTags(array $tags, string $group): array
    {
        $types = [];
        foreach ($tags as $tag) {
            if (! str_starts_with($tag, $group.':')) {
                continue;
            }
            [, $name] = explode(':', $tag);
            [$type]   = explode('-', $name);
            $types[]  = $type;
        }

        return array_values(array_unique($types));
    }
}
