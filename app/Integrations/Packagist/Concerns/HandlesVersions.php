<?php

declare(strict_types=1);

namespace App\Integrations\Packagist\Concerns;

use Illuminate\Support\Collection;

trait HandlesVersions
{
    protected function getVersion(array $packageMeta, ?string $channel): string
    {
        $versions = collect(array_keys($packageMeta['versions']));

        if ($versions->contains($channel)) {
            return $channel;
        }

        $version = '';

        switch ($channel) {
            case 'latest':
                $version = $this->latest($this->noDev($versions));
                break;
            case 'pre':
                $version = $this->latest($this->pre($versions));
                break;
            default:
                $version = $this->latest($this->stable($versions));
        }

        return $version ?? $this->latest($versions);
    }

    protected function pre(Collection $versions): Collection
    {
        return $versions
            ->filter(fn (string $version) => str_contains($version, '-'))
            ->filter(fn (string $version) => str_contains($version, 'dev'));
    }

    protected function stable(Collection $versions): Collection
    {
        return $versions->reject(fn (string $version) => str_contains($version, '-'));
    }

    protected function noDev(Collection $versions): Collection
    {
        return $versions->reject(fn (string $version) => str_contains($version, 'dev'));
    }

    protected function latest(Collection $versions): string
    {
        return $versions->last();
    }
}
