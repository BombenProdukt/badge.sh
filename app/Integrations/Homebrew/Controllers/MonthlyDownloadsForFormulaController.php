<?php

declare(strict_types=1);

namespace App\Integrations\Homebrew\Controllers;

use App\Integrations\Actions\FormatNumber;
use App\Integrations\Homebrew\Client;
use Illuminate\Routing\Controller;

final class MonthlyDownloadsForFormulaController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $package): array
    {
        $count = $this->client->get('formula', $package)['analytics']['install']['30d'][$package];

        return [
            'label'       => 'downloads',
            'status'      => FormatNumber::execute($count).'/month',
            'statusColor' => 'green.600',
        ];
    }
}
