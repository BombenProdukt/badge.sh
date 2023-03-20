<?php

declare(strict_types=1);

namespace App\Badges\Docsrs\Badges;

use App\Badges\Docsrs\Client;
use App\Badges\Templates\StatusTemplate;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class StatusBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $crate, ?string $version = 'latest'): array
    {
        $label = "docs@{$version}";

        if ($this->client->status($crate, $version)) {
            return StatusTemplate::make($label, 'passing');
        }

        return StatusTemplate::make($label, 'failing');
    }

    public function service(): string
    {
        return 'docs.rs';
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
            '/docsrs/version/{crate}/{version?}',
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
            '/docsrs/version/regex' => 'version',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
