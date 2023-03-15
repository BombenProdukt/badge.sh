<?php

declare(strict_types=1);

namespace App\Integrations\DUB\Controllers;

use App\Integrations\Actions\FormatNumber;
use App\Integrations\DUB\Client;
use Illuminate\Routing\Controller;

final class MonthlyDownloadsController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $package): array
    {
        $downloads = $this->client->get("{$package}/stats")['downloads'];

        return [
            'label'       => 'downloads',
            'status'      => FormatNumber::execute($downloads['monthly']).'/month',
            'statusColor' => 'green.600',
        ];
    }
}
