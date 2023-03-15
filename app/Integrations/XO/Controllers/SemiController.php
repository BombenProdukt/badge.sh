<?php

declare(strict_types=1);

namespace App\Integrations\XO\Controllers;

use App\Integrations\XO\Client;
use Illuminate\Routing\Controller;

final class SemiController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $name): array
    {
        $response = $this->client->get($name);

        if (empty($response['devDependencies']) || empty($response['devDependencies']['xo'])) {
            return [
                'label'       => 'xo',
                'status'      => 'not enabled',
                'statusColor' => 'gray.600',
            ];
        }

        return [
            'label'       => 'semicolons',
            'status'      => $response['xo']['semicolon'] ? 'enabled' : 'disabled',
            'statusColor' => '5ED9C7',
        ];
    }
}
