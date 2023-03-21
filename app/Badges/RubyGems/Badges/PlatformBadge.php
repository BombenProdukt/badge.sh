<?php

declare(strict_types=1);

namespace App\Badges\RubyGems\Badges;

use App\Badges\AbstractBadge;
use App\Badges\RubyGems\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class PlatformBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $gem): array
    {
        return [
            'label'        => 'platform',
            'message'      => $this->client->get("gems/{$gem}")['platform'],
            'messageColor' => 'green.600',
        ];
    }

    public function service(): string
    {
        return 'RubyGems';
    }

    public function keywords(): array
    {
        return [Category::PLATFORM_SUPPORT];
    }

    public function routePaths(): array
    {
        return [
            '/rubygems/platform/{gem}',
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
            '/rubygems/platform/rails' => 'platform',
        ];
    }
}
