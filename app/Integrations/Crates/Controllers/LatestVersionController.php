<?php

declare(strict_types=1);

namespace App\Integrations\Crates\Controllers;

use App\Integrations\Actions\ExtractVersion;
use App\Integrations\Actions\ExtractVersionColor;
use App\Integrations\Crates\Client;
use Illuminate\Routing\Controller;

final class LatestVersionController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $package): array
    {
        $version = $this->client->get($package)['max_version'];

        return [
            'label'       => 'crates.io',
            'status'      => ExtractVersion::execute($version),
            'statusColor' => ExtractVersionColor::execute($version),
        ];
    }
}
