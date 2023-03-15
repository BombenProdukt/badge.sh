<?php

declare(strict_types=1);

namespace App\Integrations\OPAM\Controllers;

use App\Integrations\OPAM\Client;
use Illuminate\Routing\Controller;

final class LicenseController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $name): array
    {
        preg_match('/<th>license<\/th>\s*<td>([^<]+)<\//i', $this->client->get($name), $matches);

        return [
            'label'       => 'license',
            'status'      => $matches[1] ?? 'unknown',
            'statusColor' => 'blue.600',
        ];
    }
}
