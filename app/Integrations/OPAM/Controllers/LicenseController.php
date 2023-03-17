<?php

declare(strict_types=1);

namespace App\Integrations\OPAM\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\OPAM\Client;

final class LicenseController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $name): array
    {
        preg_match('/<th>license<\/th>\s*<td>([^<]+)<\//i', $this->client->get($name), $matches);

        return [
            'label'       => 'license',
            'status'      => $matches[1] ?? 'unknown',
            'statusColor' => 'blue.600',
        ];
    }
}
