<?php

declare(strict_types=1);

namespace App\Integrations\Snapcraft\Controllers;

use App\Integrations\Actions\ExtractVersion;
use App\Integrations\Actions\ExtractVersionColor;
use App\Integrations\Snapcraft\Client;
use Closure;
use Illuminate\Routing\Controller;

final class VersionController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $snap, ?string $architecture = null, ?string $channel = null): array
    {
        $response = $this->client->get($snap, ['version']);
        $channel  = collect($response['channel-map'])->firstWhere($this->createChannelMatcher($architecture, $channel));

        return [
            'label'        => 'snap',
            'status'       => ExtractVersion::execute($channel['version']),
            'statusColor'  => ExtractVersionColor::execute($channel['version']),
        ];
    }

    protected function createChannelMatcher(?string $architecture, ?string $channel): Closure
    {
        $matchArchitecture = $architecture
          ? fn ($channel) => $channel['architecture'] === $architecture
          : fn () => true;

        $matchChannel = $channel
          ? fn ($channel) => $channel['name'] === $channel
          : fn () => true;

        return fn ($it) => $matchArchitecture($it) && $matchChannel($it);
    }
}
