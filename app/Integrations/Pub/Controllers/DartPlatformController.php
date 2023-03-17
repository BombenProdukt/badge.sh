<?php

declare(strict_types=1);

namespace App\Integrations\Pub\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Pub\Client;

final class DartPlatformController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $package): array
    {
        $pubScores = $this->client->api("packages/{$package}/metrics")['scorecard'];
        $sdk       = implode('|', $this->parseTags($pubScores['panaReport']['derivedTags'], 'sdk'));

        return [
            'label'       => 'dart',
            'status'      => $sdk ?? 'unknown',
            'statusColor' => $sdk ? 'blue.600' : 'gray.600',
        ];
    }

    private function parseTags(array $tags, string $group): array
    {
        $types = [];
        foreach ($tags as $tag) {
            if (! str_starts_with($tag, $group.':')) {
                continue;
            }
            [, $name] = explode(':', $tag);
            [$type]   = explode('-', $name);
            $types[]  = $type;
        }

        return array_values(array_unique($types));
    }
}
