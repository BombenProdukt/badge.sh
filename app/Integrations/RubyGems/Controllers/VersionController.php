<?php

declare(strict_types=1);

namespace App\Integrations\RubyGems\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\ExtractVersion;
use App\Integrations\Actions\ExtractVersionColor;
use App\Integrations\RubyGems\Client;

final class VersionController extends AbstractController
{
    private array $preConditions = ['.rc', '.beta', '-rc', '-beta'];

    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $gem, ?string $channel = null): array
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
