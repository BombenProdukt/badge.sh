<?php

declare(strict_types=1);

namespace App\Badges\RubyGems\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class LatestVersionDownloadsBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/rubygems/downloads-recently/{gem}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $gem): array
    {
        return [
            'downloads' => $this->client->get("gems/{$gem}")['version_downloads'],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'downloads',
            'message' => FormatNumber::execute($properties['downloads']).' /version',
            'messageColor' => 'green.600',
        ];
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
            '/rubygems/downloads-recently/rails' => 'latest version downloads',
        ];
    }
}
