<?php

declare(strict_types=1);

namespace App\Integrations\Homebrew\Controllers;

use App\Integrations\Actions\FormatNumber;
use App\Integrations\Homebrew\Client;
use Illuminate\Routing\Controller;

final class YearlyDownloadsForCaskController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $package): array
    {
        $count = $this->client->get('cask', $package)['analytics']['install']['365d'][$package];

        return [
            'label'       => 'downloads',
            'status'      => FormatNumber::execute($count).'/year',
            'statusColor' => 'green.600',
        ];
    }
}
