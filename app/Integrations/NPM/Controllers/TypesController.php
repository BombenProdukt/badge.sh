<?php

declare(strict_types=1);

namespace App\Integrations\NPM\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\NPM\Client;

final class TypesController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $package, string $tag = 'latest'): array
    {
        $response = $this->client->unpkg("{$package}@{$tag}/package.json");

        if (isset($response['types']) || isset($response['typings']) || isset($response['exports']['types'])) {
            return [
                'label'       => 'types',
                'status'      => 'included',
                'statusColor' => '0074c1',
            ];
        }

        try {
            $this->client->unpkg("{$package}/index.d.ts");

            return [
                'label'       => 'types',
                'status'      => 'included',
                'statusColor' => '0074c1',
            ];
        } catch (\Throwable) {
            //
        }

        try {
            return [
                'label'       => 'types',
                'status'      => $this->client->unpkg('@types/'.($package[0] === '@' ? str_replace('/', '__', substr($package, 1)) : $package).'/package.json')['name'],
                'statusColor' => 'cyan.600',
            ];
        } catch (\Throwable) {
            //
        }

        return [
            'label'       => 'types',
            'status'      => 'missing',
            'statusColor' => 'orange.600',
        ];
    }
}
