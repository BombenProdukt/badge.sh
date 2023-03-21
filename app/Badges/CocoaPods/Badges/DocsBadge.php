<?php

declare(strict_types=1);

namespace App\Badges\CocoaPods\Badges;

use App\Badges\CocoaPods\Client;
use App\Badges\Templates\PercentageTemplate;
use App\Contracts\Badge;
use Illuminate\Routing\Route;
use Illuminate\Support\Arr;

final class DocsBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $pod): array
    {
        return PercentageTemplate::make($this->service(), Arr::get($this->client->get($pod), 'cocoadocs.doc_percent', 0));
    }

    public function service(): string
    {
        return 'CocoaPods';
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
            '/cocoapods/doc-percent/{pod}',
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
            '/cocoapods/doc-percent/AFNetworking' => 'documentation coverage (percentage)',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
