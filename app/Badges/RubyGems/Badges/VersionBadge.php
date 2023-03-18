<?php

declare(strict_types=1);

namespace App\Badges\RubyGems\Badges;

use App\Actions\ExtractVersion;
use App\Actions\ExtractVersionColor;
use App\Badges\RubyGems\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class VersionBadge implements Badge
{
    private array $preConditions = ['.rc', '.beta', '-rc', '-beta'];

    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $gem, ?string $channel = null): array
    {
        $versions = array_column($this->client->get("versions/{$gem}"), 'number');
        rsort($versions);

        if ($channel === 'latest') {
            $version = $this->latest($versions);
        }

        if ($channel === 'pre') {
            $version = $this->latest($this->pre($versions));
        }

        if (empty($version)) {
            $version = $this->latest($this->stable($versions));
        }

        return [
            'label'        => 'rubygems',
            'status'       => ExtractVersion::execute($version),
            'statusColor'  => ExtractVersionColor::execute($version),
        ];
    }

    public function service(): string
    {
        return 'RubyGems';
    }

    public function title(): string
    {
        return '';
    }

    public function keywords(): array
    {
        return [
            //
        ];
    }

    public function routePaths(): array
    {
        return [
            '/rubygems/v/{gem}/{channel?}',
        ];
    }

    public function routeParameters(): array
    {
        return [
            //
        ];
    }

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPreviews(): array
    {
        return [
            //
        ];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/rubygems/v/rails'        => 'version (stable)',
            '/rubygems/v/rails/pre'    => 'version (pre)',
            '/rubygems/v/rails/latest' => 'version (latest)',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }

    private function pre($versions)
    {
        return array_filter($versions, function ($v) {
            foreach ($this->preConditions as $condition) {
                if (! str_contains($v, $condition)) {
                    return false;
                }
            }

            return true;
        });
    }

    private function stable($versions)
    {
        return array_filter($versions, function ($v) {
            foreach ($this->preConditions as $condition) {
                if (str_contains($v, $condition)) {
                    return false;
                }
            }

            return true;
        });
    }

    private function latest($versions)
    {
        return count($versions) > 0 ? end($versions) : null;
    }
}
