<?php

declare(strict_types=1);

namespace App\Integrations\WinGet\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\WinGet\Client;
use Symfony\Component\Yaml\Yaml;

final class LicenseController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $appId): array
    {
        $document = Yaml::parse(base64_decode($this->client->get($appId)['content']));
        $document = Yaml::parse(base64_decode($this->client->locale($appId, $document['PackageVersion'], $document['DefaultLocale'])['content']));

        return [
            'label'        => 'license',
            'status'       => str_replace(' License', '', $document['License']),
            'statusColor'  => 'blue.600',
        ];
    }
}
