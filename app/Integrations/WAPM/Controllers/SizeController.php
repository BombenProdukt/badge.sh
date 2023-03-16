<?php

declare(strict_types=1);

namespace App\Integrations\WAPM\Controllers;

use App\Integrations\Actions\FormatBytes;
use App\Integrations\WAPM\Client;
use Illuminate\Routing\Controller;

final class SizeController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $package): array
    {
        return [
            'label'        => 'distrib size',
            'status'       => FormatBytes::execute($this->client->get($package)['distribution']['size']),
            'statusColor'  => 'green.600',
        ];
    }
}
