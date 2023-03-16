<?php

declare(strict_types=1);

namespace App\Integrations\WinGet\Controllers;

use App\Integrations\WinGet\Client;
use Illuminate\Routing\Controller;
use Symfony\Component\Yaml\Yaml;

final class LicenseController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $appId): array
    {
        $document = Yaml::parse(base64_decode($this->client->get($appId)['content']));

        return [
            'label'        => 'license',
            'status'       => $document['License'] ?? 'unknown',
            'statusColor'  => 'blue.600',
        ];
    }
}
