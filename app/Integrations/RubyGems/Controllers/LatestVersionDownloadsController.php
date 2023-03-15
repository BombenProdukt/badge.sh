<?php

declare(strict_types=1);

namespace App\Integrations\RubyGems\Controllers;

use App\Integrations\Actions\FormatNumber;
use App\Integrations\RubyGems\Client;
use Illuminate\Routing\Controller;

final class LatestVersionDownloadsController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $gem): array
    {
        return [
            'label'       => 'downloads',
            'status'      => FormatNumber::execute($this->client->get("gems/{$gem}")['version_downloads']).' /version',
            'statusColor' => 'green.600',
        ];
    }
}
