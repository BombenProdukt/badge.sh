<?php

declare(strict_types=1);

namespace App\Badges\WordPress\Badges;

use App\Badges\AbstractBadge;
use App\Badges\WordPress\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class CommercialBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $extensionType, string $extension): array
    {
        return $this->renderText('commercial', $this->client->info($extensionType, $extension)['is_commercial'] ? 'yes' : 'no');
    }

    public function service(): string
    {
        return 'WordPress';
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/wordpress/{extensionType}/commercial/{extension}',
        ];
    }

    public function routeConstraints(Route $route): void
    {
        $route->whereIn('extensionType', ['plugin', 'theme']);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/wordpress/plugin/commercial/bbpress'        => 'commercial status (plugin)',
            '/wordpress/theme/commercial/twentyseventeen' => 'commercial status (theme)',
        ];
    }
}
