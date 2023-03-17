<?php

declare(strict_types=1);

namespace App\Integrations\JSDelivr\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\ExtractVersionColor;
use App\Integrations\JSDelivr\Client;

final class VersionController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $package): array
    {
        $version = $this->client->cdn($package)['version'];

        return [
            'label'        => 'jsDelivr',
            'status'       => "v{$version}",
            'statusColor'  => ExtractVersionColor::execute($version),
        ];
    }
}
