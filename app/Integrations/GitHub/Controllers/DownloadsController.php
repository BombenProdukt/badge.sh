<?php

declare(strict_types=1);

namespace App\Integrations\GitHub\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\FormatNumber;
use App\Integrations\GitHub\Client;
use GrahamCampbell\GitHub\Facades\GitHub;

final class DownloadsController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $owner, string $repo, ?string $tag = ''): array
    {
        $release = GitHub::api('repo')->releases()->show($owner, $repo, $tag ? "tags/{$tag}" : 'latest');

        if (! $release || ! $release['assets'] || ! count($release['assets'])) {
            return [
                'label'       => 'downloads',
                'status'      => 'no assets',
                'statusColor' => 'gray.600',
            ];
        }

        $downloadCount = array_reduce($release['assets'], function ($result, $asset) {
            return $result + $asset['download_count'];
        }, 0);

        return [
            'label'       => 'downloads',
            'status'      => FormatNumber::execute($downloadCount),
            'statusColor' => 'green.600',
        ];
    }
}
