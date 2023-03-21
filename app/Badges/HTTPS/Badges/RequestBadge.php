<?php

declare(strict_types=1);

namespace App\Badges\HTTPS\Badges;

use App\Badges\AbstractBadge;
use App\Badges\HTTPS\Client;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class RequestBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $host, ?string $path = null): array
    {
        $response = $this->client->get($host, $path);

        return [
            'label'        => $response['label'] ?? $response['subject'],
            'message'      => $response['status'],
            'messageColor' => $response['statusColor'] ?? $response['color'].'.600',
        ];
    }

    public function service(): string
    {
        return 'HTTPS';
    }

    public function title(): string
    {
        return '';
    }

    public function keywords(): array
    {
        return [Category::OTHER];
    }

    public function routePaths(): array
    {
        return [
            '/https/{host}/{path?}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('path', RoutePattern::CATCH_ALL->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/https/cal-badge-icd0onfvrxx6.runkit.sh'                     => 'https endpoint',
            '/https/cal-badge-icd0onfvrxx6.runkit.sh/Asia/Shanghai'       => 'https endpoint (with path args)',
            '/https/cal-badge-icd0onfvrxx6.runkit.sh/America/Los_Angeles' => 'https endpoint (with path args)',
        ];
    }
}
