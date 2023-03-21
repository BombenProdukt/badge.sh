<?php

declare(strict_types=1);

namespace App\Badges\Bugzilla\Badges;

use App\Badges\Bugzilla\Client;
use App\Badges\Templates\TextTemplate;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class StatusBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $bug): array
    {
        $response = $this->client->get($bug);
        $status   = strtolower($response['status'] === 'RESOLVED' ? $response['resolution'] : $response['status']);

        return TextTemplate::make(
            "bug {$bug}",
            match ($status) {
                'worksforme' => 'works for me',
                'wontfix'    => "won't fix",
                default      => $status,
            },
            match ($status) {
                'unconfirmed' => 'blue.600',
                'new'         => 'blue.600',
                'assigned'    => 'green.600',
                'fixed'       => 'emerald.600',
                'invalid'     => 'yellow.600',
                'wontfix'     => 'orange.600',
                'duplicate'   => 'slate.600',
                'worksforme'  => 'lime.600',
                'incomplete'  => 'red.600',
                default       => 'gray.600',
            });
    }

    public function service(): string
    {
        return 'Bugzilla';
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
            '/bugzilla/status/{bug}',
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
            '/bugzilla/status/996038' => 'status',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
