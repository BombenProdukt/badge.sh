<?php

declare(strict_types=1);

namespace App\Integrations\ElmPackage\Controllers;

use App\Integrations\Actions\ExtractVersion;
use App\Integrations\Actions\ExtractVersionColor;
use App\Integrations\ElmPackage\Client;
use Illuminate\Routing\Controller;

final class VersionController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $owner, string $name): array
    {
        $version = $this->client->get($owner, $name)['version'];

        return [
            'label'        => 'elm package',
            'status'       => ExtractVersion::execute($version),
            'statusColor'  => ExtractVersionColor::execute($version),
        ];
    }
}
