<?php

declare(strict_types=1);

namespace App\Integrations\FDroid\Controllers;

use App\Integrations\Actions\ExtractVersion;
use App\Integrations\Actions\ExtractVersionColor;
use App\Integrations\FDroid\Client;
use Illuminate\Routing\Controller;

final class VersionController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $appId): array
    {
        $version = $this->client->get($appId)['CurrentVersion'];

        return [
            'label'        => 'opam',
            'status'       => ExtractVersion::execute($version),
            'statusColor'  => ExtractVersionColor::execute($version),
        ];
    }
}
