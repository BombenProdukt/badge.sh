<?php

declare(strict_types=1);

namespace App\Integrations\OpenVSX\Controllers;

use App\Integrations\Actions\ExtractVersion;
use App\Integrations\Actions\ExtractVersionColor;
use App\Integrations\OpenVSX\Client;
use Illuminate\Routing\Controller;

final class VersionController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $namespace, string $package): array
    {
        $response = $this->client->get($namespace, $package);

        return [
            'label'        => 'version',
            'status'       => ExtractVersion::execute($response['version']),
            'statusColor'  => ExtractVersionColor::execute($response['version']),
        ];
    }
}
