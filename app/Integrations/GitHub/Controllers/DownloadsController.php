<?php

declare(strict_types=1);

namespace App\Integrations\GitHub\Controllers;

use App\Integrations\Actions\FormatNumber;
use App\Integrations\GitHub\Client;
use GrahamCampbell\GitHub\Facades\GitHub;
use Illuminate\Routing\Controller;

final class DownloadsController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $owner, string $repo, ?string $tag = ''): array
    {
        $release = GitHub::api('repo')->releases()->show($owner, $repo, $tag ? "tags/{$tag}" : 'latest');

        if (! $release || ! $release['assets'] || ! count($release['assets'])) {
            return [
                'label'       => 'downloads',
                'status'      => 'no assets',
                'statusColor' => 'grey.600',
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
