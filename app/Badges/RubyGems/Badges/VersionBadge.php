<?php

declare(strict_types=1);

namespace App\Badges\RubyGems\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected string $route = '/rubygems/version/{gem}/{channel?}';

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
            new BadgePreviewData(
                name: 'version (stable)',
                path: '/rubygems/version/rails',
                data: $this->render(['version' => '1.0.0']),
            ),
            new BadgePreviewData(
                name: 'version (pre)',
                path: '/rubygems/version/rails/pre',
                data: $this->render(['version' => '1.0.0']),
            ),
            new BadgePreviewData(
                name: 'version (latest)',
                path: '/rubygems/version/rails/latest',
                data: $this->render(['version' => '1.0.0']),
            ),
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
