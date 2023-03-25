<?php

declare(strict_types=1);

namespace App\Badges\Sonar;

use Illuminate\Support\Facades\Http;
use Throwable;

final class Client
{
    public function get(string $instance, string $sonarVersion, string $metricName, string $component, string $branch): array
    {
        if ($this->isLegacyVersion($sonarVersion)) {
            return $this->legacy($instance, $metricName, $component, $branch);
        }

        return $this->current($instance, $sonarVersion, $metricName, $component, $branch);
    }

    private function legacy(string $instance, string $metricName, string $component, string $branch): array
    {
        $response = Http::baseUrl($instance)->throw()->get('', [
            'resource' => $component,
            'depth' => 0,
            'metrics' => $metricName,
            'includeTrends' => true,
            'branch' => $branch,
        ])->json('0.mrs');

        $result = [];

        foreach ($response as $measure) {
            $result[$measure['key']] = $measure['val'];
        }

        return $result;
    }

    private function current(string $instance, string $sonarVersion, string $metricName, string $component, string $branch): array
    {
        $response = Http::baseUrl($instance)->throw()->get('', [
            [(float) $sonarVersion >= 6.6 ? 'component' : 'componentKey'] => $component,
            'metricKeys' => $metricName,
            'branch' => $branch,
        ])->json('component.measures');

        $result = [];

        foreach ($response as $measure) {
            $result[$measure['key']] = $measure['value'];
        }

        return $result;
    }

    private function isLegacyVersion(string $sonarVersion): bool
    {
        try {
            return (float) $sonarVersion < 5.4;
        } catch (Throwable) {
            return false;
        }
    }
}
