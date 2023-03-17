<?php

declare(strict_types=1);

namespace App\Integrations\RubyGems\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\FormatNumber;
use App\Integrations\RubyGems\Client;

final class LatestVersionDownloadsController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $gem): array
    {
        return [
            'label'       => 'downloads',
            'status'      => FormatNumber::execute($this->client->get("gems/{$gem}")['version_downloads']).' /version',
            'statusColor' => 'green.600',
        ];
    }
}
