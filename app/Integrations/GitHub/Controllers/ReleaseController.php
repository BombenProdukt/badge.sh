<?php

declare(strict_types=1);

namespace App\Integrations\GitHub\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\ExtractVersion;
use App\Integrations\GitHub\Client;
use GrahamCampbell\GitHub\Facades\GitHub;

final class ReleaseController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $owner, string $repo, ?string $channel = 'stable'): array
    {
        $releases = GitHub::api('repo')->releases()->show($owner, $repo);

        if (empty($releases)) {
            return [
                'label'       => 'release',
                'status'      => 'none',
                'statusColor' => 'yellow.600',
            ];
        }

        if ($channel === 'stable') {
            $stable = collect($releases)->firstWhere('prerelease', false);

            return [
                'label'       => 'release',
                'status'      => ExtractVersion::execute($stable ? $stable['name'] ?? $stable['tag_name'] : null),
                'statusColor' => 'blue.600',
            ];
        }

        return [
            'label'       => 'release',
            'status'      => ExtractVersion::execute($releases[0]['name'] ?? $releases[0]['tag_name']),
            'statusColor' => $releases[0]['prerelease'] ? 'orange.600' : 'blue.600',
        ];
    }
}
