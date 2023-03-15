<?php

declare(strict_types=1);

namespace App\Integrations\OPAM\Controllers;

use App\Integrations\Actions\ExtractVersion;
use App\Integrations\Actions\ExtractVersionColor;
use App\Integrations\OPAM\Client;
use Illuminate\Routing\Controller;

final class VersionController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $name): array
    {
        preg_match('/class="package-version">([^<]+)<\//i', $this->client->get($name), $matches);

        return [
            'label'        => 'opam',
            'status'       => ExtractVersion::execute($matches[1]),
            'statusColor'  => ExtractVersionColor::execute($matches[1]),
        ];
    }
}
