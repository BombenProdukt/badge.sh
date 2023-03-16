<?php

declare(strict_types=1);

namespace App\Integrations\Packagist\Controllers;

use App\Integrations\Actions\ExtractVersion;
use App\Integrations\Actions\ExtractVersionColor;
use App\Integrations\Packagist\Client;
use App\Integrations\Packagist\Concerns\HandlesVersions;
use Illuminate\Routing\Controller;

final class VersionController extends Controller
{
    use HandlesVersions;

    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $vendor, string $package, ?string $channel = null): array
    {
        $version = $this->getVersion($this->client->get($vendor, $package), $channel);

        return [
            'label'        => 'packagist',
            'status'       => ExtractVersion::execute($version),
            'statusColor'  => ExtractVersionColor::execute($version),
        ];
    }
}
