<?php

declare(strict_types=1);

namespace App\Badges\ROS\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;
use Spatie\Regex\Regex;

final class VersionBadge extends AbstractBadge
{
    public function handle(string $distro, string $repoName): array
    {
        $tags = collect($this->client->refs($distro))
            ->map(fn (array $version) => $version['node']['name'])
            ->filter(fn (string $name) => Regex::match('|^\d+-\d+-\d+$|', $name)->hasMatch())
            ->sort()
            ->reverse();

        return $this->renderVersion(
            $this->client->content($distro, $tags[0] ? "refs/tags/{$distro}/{$tags[0]}" : 'refs/heads/master')['repositories'][$repoName]['release']['version'],
            'ros | humble',
        );
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/ros/version/{distro}/{repoName}',
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
            '/ros/version/humble/vision_msgs' => 'version',
        ];
    }
}
