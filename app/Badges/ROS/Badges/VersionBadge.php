<?php

declare(strict_types=1);

namespace App\Badges\ROS\Badges;

use App\Enums\Category;
use Spatie\Regex\Regex;

final class VersionBadge extends AbstractBadge
{
    protected array $routes = [
        '/ros/version/{distro}/{repoName}',
    ];

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $distro, string $repoName): array
    {
        $tags = collect($this->client->refs($distro))
            ->map(fn (array $version) => $version['node']['name'])
            ->filter(fn (string $name) => Regex::match('|^\d+-\d+-\d+$|', $name)->hasMatch())
            ->sort()
            ->reverse();

        return $this->client->content($distro, $tags[0] ? "refs/tags/{$distro}/{$tags[0]}" : 'refs/heads/master')['repositories'][$repoName]['release'];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version'], 'ros | humble');
    }

    public function previews(): array
    {
        return [
            '/ros/version/humble/vision_msgs' => 'version',
        ];
    }
}
