<?php

declare(strict_types=1);

namespace App\Integrations\NuGet\Controllers;

use App\Integrations\Actions\FormatNumber;
use App\Integrations\NuGet\Client;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;

final class TotalDownloadsController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $package): array
    {
        $totalDownloads = Http::get('https://azuresearch-usnc.nuget.org/query', [
            'q'           => 'packageid:'.strtolower($package),
            'prerelease'  => 'true',
            'semVerLevel' => 2,
        ])->throw()->json('data.0.totalDownloads');

        return [
            'label'       => 'downloads',
            'status'      => FormatNumber::execute($totalDownloads),
            'statusColor' => 'green.600',
        ];
    }
}
