<?php

declare(strict_types=1);

namespace App\Badges\RubyGems\Badges;

use App\Badges\AbstractBadge;
use App\Badges\RubyGems\Client;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class LatestVersionDownloadsBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $gem): array
    {
        return [
            'label'        => 'downloads',
            'message'      => FormatNumber::execute($this->client->get("gems/{$gem}")['version_downloads']).' /version',
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
        return [];
    }

    public function routePaths(): array
    {
        return [
            '/rubygems/downloads-recently/{gem}',
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
            '/rubygems/downloads-recently/rails' => 'latest version downloads',
        ];
    }
}
