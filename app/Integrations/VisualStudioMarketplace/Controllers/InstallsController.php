<?php

declare(strict_types=1);

namespace App\Integrations\VisualStudioMarketplace\Controllers;

use App\Integrations\Actions\FormatNumber;
use App\Integrations\VisualStudioMarketplace\Client;
use Illuminate\Routing\Controller;

final class InstallsController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $extension): array
    {
        $response = collect($this->client->get($extension));
        $install  = collect($response['statistics'])->firstWhere('statisticName', 'install')['value'];

        return [
            'label'        => 'install',
            'status'       => FormatNumber::execute($install),
            'statusColor'  => 'green.600',
        ];
    }
}
