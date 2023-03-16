<?php

declare(strict_types=1);

namespace App\Integrations\Docker\Controllers;

use App\Integrations\Docker\Client;
use Illuminate\Routing\Controller;

final class MetadataController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(
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
