<?php

declare(strict_types=1);

namespace App\Badges\RubyGems\Badges;

use App\Badges\AbstractBadge;
use App\Badges\RubyGems\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class NameBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $gem): array
    {
        return [
            'label'        => 'name',
            'message'      => $this->client->get("gems/{$gem}")['name'],
            'messageColor' => 'green.600',
        ];
    }

    public function service(): string
    {
        return 'RubyGems';
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
            '/rubygems/name/{gem}',
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
            '/rubygems/name/rails' => 'name',
        ];
    }
}
