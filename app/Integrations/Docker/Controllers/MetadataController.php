<?php

declare(strict_types=1);

namespace App\Integrations\Docker\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Docker\Client;

final class MetadataController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(
        string $type,
        string $scope,
        string $name,
        string $tag = 'latest',
        string $architecture = 'amd64',
        string $variant = '',
    ): array {
        $response = $this->client->config($scope, $name, $tag, $architecture, $variant);

        return [
            'label'       => $type,
            'status'      => $response['container_config']['Labels']["org.label-schema.{$type}"] ?? $response['container_config']['Labels']["org.opencontainers.image.{$type}"],
            'statusColor' => 'blue.600',
        ];
    }
}
