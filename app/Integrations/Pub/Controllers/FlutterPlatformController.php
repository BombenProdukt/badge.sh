<?php

declare(strict_types=1);

namespace App\Integrations\Pub\Controllers;

use App\Integrations\Pub\Client;
use Illuminate\Routing\Controller;

final class FlutterPlatformController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $package): array
    {
        $pubScores = $this->client->api("packages/{$package}/metrics")['scorecard'];
        $platforms = implode('|', $this->parseTags($pubScores['panaReport']['derivedTags'], 'platform'));

        return [
            'label'       => 'flutter',
            'status'      => $platforms ?? 'unknown',
            'statusColor' => $platforms ? 'blue.600' : 'gray.600',
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
