<?php

declare(strict_types=1);

namespace App\Integrations\Bundlephobia\Controllers;

use App\Integrations\Actions\FormatBytes;
use App\Integrations\Bundlephobia\Client;
use Illuminate\Routing\Controller;

final class MinController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $name): array
    {
        return [
            'label'       => 'minified size',
            'status'      => FormatBytes::execute($this->client->get($name)['size']),
            'statusColor' => 'blue.600',
        ];
    }
}
