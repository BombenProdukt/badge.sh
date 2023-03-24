<?php

declare(strict_types=1);

namespace App\Badges\Nexus;

use Illuminate\Support\Facades\Http;
use Throwable;

final class Client
{
    public function get(string $instance, string $inexusVersion, string $query, string $repo, string $groupId, string $artifactId): string
    {
        if ($inexusVersion === '2') {
            try {
                return $this->nexus2($instance, $query, $repo, $groupId, $artifactId);
            } catch (Throwable) {
                return $this->nexus3($instance, $query, $repo, $groupId, $artifactId);
            }
        }

        return $this->nexus3($instance, $query, $repo, $groupId, $artifactId);
    }

    private function nexus2(string $instance, string $query, string $repo, string $groupId, string $artifactId): string
    {
        $searchParams = array_merge([
            'g' => $groupId,
            'a' => $artifactId,
        ], match ($repo) {
            's'     => [],
            'r'     => [],
            default => ['r' => $repo, 'v' => 'LATEST']
        });

        if (! empty($query)) {
            $searchParams = $this->addQueryParamsToQueryString($searchParams, $query);
        }

        $response = Http::baseUrl($instance)->throw()->get(match ($repo) {
            's'     => 'service/local/lucene/search',
            'r'     => 'service/local/lucene/search',
            default => 'service/local/artifact/maven/resolve'
        })->json();

        if ($repo === 'r') {
            return $response['data'][0]['latestRelease'];
        }

        if ($repo === 's') {
            foreach ($response['data'] as $artifact) {
                if ($this->isSnapshotVersion($artifact['latestSnapshot'])) {
                    return $artifact['latestSnapshot'];
                }

                if ($this->isSnapshotVersion($artifact['version'])) {
                    return $artifact['version'];
                }
            }
        }

        return $response['data']['baseVersion'] ?? $response['data']['version'];
    }

    private function nexus3(string $instance, string $query, string $repo, string $groupId, string $artifactId): string
    {
        $searchParams = array_merge([
            'group' => $groupId,
            'name'  => $artifactId,
            'sort'  => 'version',
        ], match ($repo) {
            's'     => ['prerelease' => 'true'],
            'r'     => ['prerelease' => 'false'],
            default => ['repository' => $repo]
        });

        if (! empty($query)) {
            $searchParams = $this->addQueryParamsToQueryString($searchParams, $query);
        }

        return Http::baseUrl($instance)->throw()->get('service/rest/v1/search', $searchParams)->json('items.0.version');
    }

    private function addQueryParamsToQueryString(array $searchParams, string $queryOpt): array
    {
        $keyValuePairs = explode(':', $queryOpt);

        foreach ($keyValuePairs as $keyValuePair) {
            $paramParts              = explode('=', $keyValuePair);
            $paramKey                = $paramParts[0];
            $paramValue              = $paramParts[1];
            $searchParams[$paramKey] = $paramValue;
        }

        return $searchParams;
    }

    private function isSnapshotVersion(string $version): bool
    {
        return str_contains($version, '-SNAPSHOT');
    }
}
