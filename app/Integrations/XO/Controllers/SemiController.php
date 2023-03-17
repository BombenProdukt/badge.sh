<?php

declare(strict_types=1);

namespace App\Integrations\XO\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\XO\Client;
use Illuminate\Support\Arr;

final class SemiController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $name): array
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
            'status'      => Arr::get($response, 'xo.semicolon') ? 'enabled' : 'disabled',
            'statusColor' => '5ED9C7',
        ];
    }
}
