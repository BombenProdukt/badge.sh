<?php

declare(strict_types=1);

namespace App\Integrations\CPAN\Controllers;

use App\Integrations\Actions\FormatBytes;
use App\Integrations\CPAN\Client;
use Illuminate\Routing\Controller;

final class SizeController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $distribution): array
    {
        return [
            'label'       => 'size',
            'status'      => FormatBytes::execute($this->client->get("release/{$distribution}")['stat']['size']),
            'statusColor' => 'blue.600',
        ];
    }
}
