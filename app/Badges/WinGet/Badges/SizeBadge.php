<?php

declare(strict_types=1);

namespace App\Badges\WinGet\Badges;

use App\Badges\AbstractBadge;
use App\Badges\WinGet\Client;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatBytes;

final class SizeBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $appId): array
    {
        return [
            'label'        => 'winget',
            'message'      => FormatBytes::execute($this->client->get($appId)['size']),
            'messageColor' => 'blue.600',
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
        return [];
    }

    public function routePaths(): array
    {
        return [
            '/winget/size/{appId}',
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
            '/winget/size/GitHub.cli' => 'size',
        ];
    }
}
