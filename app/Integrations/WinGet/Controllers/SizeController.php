<?php

declare(strict_types=1);

namespace App\Integrations\WinGet\Controllers;

use App\Integrations\Actions\FormatBytes;
use App\Integrations\WinGet\Client;
use Illuminate\Routing\Controller;

final class SizeController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $appId): array
    {
        return [
            'label'        => 'winget',
            'status'       => FormatBytes::execute($this->client->get($appId)['size']),
            'statusColor'  => 'blue.600',
        ];
    }
}
