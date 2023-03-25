<?php

declare(strict_types=1);

namespace App\Badges\RubyGems\Badges;

use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected array $routes = [
        '/rubygems/version/{gem}/{channel?}',
    ];

    protected array $keywords = [
        Category::VERSION,
    ];

    private array $preConditions = ['.rc', '.beta', '-rc', '-beta'];

    public function handle(string $gem, ?string $channel = null): array
    {
        $versions = \array_column($this->client->get("versions/{$gem}"), 'number');
        \rsort($versions);

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

    public function previews(): array
    {
        return [
            '/rubygems/version/rails' => 'version (stable)',
            '/rubygems/version/rails/pre' => 'version (pre)',
            '/rubygems/version/rails/latest' => 'version (latest)',
        ];
    }

    private function pre($versions)
    {
        return \array_filter($versions, function ($v) {
            foreach ($this->preConditions as $condition) {
                if (!\str_contains($v, $condition)) {
                    return false;
                }
            }

            return true;
        });
    }

    private function stable($versions)
    {
        return \array_filter($versions, function ($v) {
            foreach ($this->preConditions as $condition) {
                if (\str_contains($v, $condition)) {
                    return false;
                }
            }

            return true;
        });
    }

    private function latest($versions)
    {
        return \count($versions) > 0 ? \end($versions) : null;
    }
}
