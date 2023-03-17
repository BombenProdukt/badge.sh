<?php

declare(strict_types=1);

namespace App\Integrations\Packagist\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Packagist\Client;
use App\Integrations\Packagist\Concerns\HandlesVersions;
use Illuminate\Support\Arr;

final class PhpVersionController extends AbstractController
{
    use HandlesVersions;

    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $vendor, string $package, ?string $channel = null): array
    {
        $packageMeta = $this->client->get($vendor, $package);

        $pkg = Arr::get($packageMeta['versions'], $this->getVersion($packageMeta, $channel));

        return [
            'label'       => 'php',
            'status'      => Arr::get($pkg, 'require.php', '*'),
            'statusColor' => 'green.600',
        ];
    }
}
