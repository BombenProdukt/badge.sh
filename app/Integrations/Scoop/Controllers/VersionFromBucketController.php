<?php

declare(strict_types=1);

namespace App\Integrations\Scoop\Controllers;

use App\Integrations\Actions\ExtractVersion;
use App\Integrations\Actions\ExtractVersionColor;
use App\Integrations\Scoop\Client;
use Illuminate\Routing\Controller;

final class VersionFromBucketController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $bucket, string $app): array
    {
        $response = $bucket === 'main' ? $this->client->main($app) : $this->client->extra($app);

        return [
            'label'        => 'scoop',
            'status'       => ExtractVersion::execute($response['version']),
            'statusColor'  => ExtractVersionColor::execute($response['version']),
        ];
    }
}
