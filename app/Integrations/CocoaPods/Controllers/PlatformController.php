<?php

declare(strict_types=1);

namespace App\Integrations\CocoaPods\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\CocoaPods\Client;

final class PlatformController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $pod): array
    {
        return [
            'label'       => 'platform',
            'status'      => implode('|', array_keys($this->client->get($pod)['platforms'])),
            'statusColor' => 'gray.600',
        ];
    }
}
