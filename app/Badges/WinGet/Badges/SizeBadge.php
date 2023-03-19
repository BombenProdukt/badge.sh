<?php

declare(strict_types=1);

namespace App\Badges\WinGet\Badges;

use App\Badges\WinGet\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatBytes;

final class SizeBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $appId): array
    {
        return [
            'label'        => 'winget',
            'status'       => FormatBytes::execute($this->client->get($appId)['size']),
            'statusColor'  => 'blue.600',
        ];
    }

    public function service(): string
    {
        return 'winget';
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
            '/winget/{appId}/size',
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
            '/winget/GitHub.cli/size' => 'size',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
