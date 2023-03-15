<?php

declare(strict_types=1);

namespace App\Integrations\MELPA\Controllers;

use App\Integrations\Actions\ExtractVersion;
use App\Integrations\Actions\ExtractVersionColor;
use App\Integrations\MELPA\Client;
use Illuminate\Routing\Controller;

final class VersionController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $package): array
    {
        preg_match('/<title>([^<]+)<\//i', $this->client->get($package), $matches);

        [, $version] = explode(':', trim($matches[1]));

        return [
            'label'        => 'melpa',
            'status'       => ExtractVersion::execute($version),
            'statusColor'  => ExtractVersionColor::execute($version),
        ];
    }
}
