<?php

declare(strict_types=1);

namespace App\Badges\Nexus\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class VersionBadge extends AbstractBadge
{
    protected array $routes = [
        '/nexus/version/{repo}/{groupId}/{artifactId}',
    ];

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $repo, string $groupId, string $artifactId): array
    {
        return [
            'version' => $this->client->get($this->getRequestData('instance'), $this->getRequestData('nexusVersion'), $this->getRequestData('query'), $repo, $groupId, $artifactId),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version']);
    }

    public function routeRules(): array
    {
        return [
            'instance' => ['required', 'url'],
            'nexusVersion' => ['required', 'in:2,3'],
            'query' => ['nullable', 'string'],
        ];
    }

    public function routeConstraints(Route $route): void
    {
        $route->whereIn('repo', ['r', 's']);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/nexus/version/r/org.apache.commons/commoin-lang3?instance=https://nexus.pentaho.org' => 'Sonatype Nexus (Releases)',
            '/nexus/version/r/com.google.guava/guava?instance=https://oss.sonatype.org' => 'Sonatype Nexus (Snapshots)',
            '/nexus/version/r/developer/ai.h2o/h2o-automl?instance=https://repository.jboss.org/nexus' => 'Sonatype Nexus (Repository)',
            '/nexus/version/r/fs-public-snapshots/com.progress.fuse/fusehq?instance=https://repository.jboss.org/nexus' => 'Sonatype Nexus (Query Options)',
        ];
    }
}
