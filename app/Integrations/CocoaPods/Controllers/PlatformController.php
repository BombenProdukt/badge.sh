<?php

declare(strict_types=1);

namespace App\Integrations\CocoaPods\Controllers;

use App\Integrations\CocoaPods\Client;
use Illuminate\Routing\Controller;

final class PlatformController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $pod): array
    {
        return [
            'label'       => 'platform',
            'status'      => implode('|', array_keys($this->client->get($pod)['platforms'])),
            'statusColor' => 'gray.600',
        ];
    }
}
