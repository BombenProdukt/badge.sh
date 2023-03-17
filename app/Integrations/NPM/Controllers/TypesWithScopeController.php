<?php

declare(strict_types=1);

namespace App\Integrations\NPM\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\NPM\Client;

final class TypesWithScopeController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $scope, string $package, string $tag = 'latest'): array
    {
        $response = $this->client->unpkg("{$scope}/{$package}@{$tag}/package.json");

        if (isset($response['types']) || isset($response['typings']) || isset($response['exports']['types'])) {
            return [
                'label'       => 'types',
                'status'      => 'included',
                'statusColor' => '0074c1',
            ];
        }

        try {
            $this->client->unpkg("{$scope}/{$package}/index.d.ts");

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
                'status'      => $this->client->unpkg('@types/'.($scope[0] === '@' ? str_replace('/', '__', substr($scope, 1)) : $scope).'/package.json')['name'],
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
