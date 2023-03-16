<?php

declare(strict_types=1);

namespace App\Integrations\Maven\Controllers;

use App\Integrations\Actions\ExtractVersion;
use App\Integrations\Actions\ExtractVersionColor;
use App\Integrations\Maven\Client;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;

final class UrlWithProtocolController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $protocol, string $hostname, string $pathname): array
    {
        $response = Http::get("{$protocol}://{$hostname}/{$pathname}")->throw()->body();

        preg_match('/<latest>(?<version>.+)<\/latest>/', $response, $matches);

        return [
            'label'       => 'maven',
            'status'      => ExtractVersion::execute($matches[1]),
            'statusColor' => ExtractVersionColor::execute($matches[1]),
        ];
    }
}
