<?php

declare(strict_types=1);

namespace App\Badges\RubyGems\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class VersionBadge extends AbstractBadge
{
    private array $preConditions = ['.rc', '.beta', '-rc', '-beta'];

    public function handle(string $gem, ?string $channel = null): array
    {
        $versions = array_column($this->client->get("versions/{$gem}"), 'number');
        rsort($versions);

        if ($channel === 'latest') {
            $version = $this->latest($versions);
        }

        if ($channel === 'pre') {
            $version = $this->latest($this->pre($versions));
        }

        if (empty($version)) {
            $version = $this->latest($this->stable($versions));
        }

        return [
            'version' => $version,
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version']);
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/rubygems/version/{gem}/{channel?}',
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
            '/rubygems/version/rails'        => 'version (stable)',
            '/rubygems/version/rails/pre'    => 'version (pre)',
            '/rubygems/version/rails/latest' => 'version (latest)',
        ];
    }

    private function pre($versions)
    {
        return array_filter($versions, function ($v) {
            foreach ($this->preConditions as $condition) {
                if (! str_contains($v, $condition)) {
                    return false;
                }
            }

            return true;
        });
    }

    private function stable($versions)
    {
        return array_filter($versions, function ($v) {
            foreach ($this->preConditions as $condition) {
                if (str_contains($v, $condition)) {
                    return false;
                }
            }

            return true;
        });
    }

    private function latest($versions)
    {
        return count($versions) > 0 ? end($versions) : null;
    }
}
