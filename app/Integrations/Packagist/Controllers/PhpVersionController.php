<?php

declare(strict_types=1);

namespace App\Integrations\Packagist\Controllers;

use App\Integrations\Packagist\Client;
use Illuminate\Routing\Controller;
use Illuminate\Support\Arr;

final class PhpVersionController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $vendor, string $package, string $channel): array
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
