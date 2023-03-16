<?php

declare(strict_types=1);

namespace App\Integrations\PyPI\Controllers;

use App\Integrations\Actions\ExtractVersion;
use App\Integrations\Actions\ExtractVersionColor;
use App\Integrations\PyPI\Client;
use Illuminate\Routing\Controller;

final class VersionController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $package): array
    {
        $version = $this->client->get($package)['version'];

        return [
            'label'        => 'pypi',
            'status'       => ExtractVersion::execute($version),
            'statusColor'  => ExtractVersionColor::execute($version),
        ];
    }
}
