<?php

declare(strict_types=1);

namespace App\StructureDiscoverer;

use App\Badges\AbstractBadge;
use Spatie\StructureDiscoverer\Cache\DiscoverCacheDriver;
use Spatie\StructureDiscoverer\Cache\LaravelDiscoverCacheDriver;
use Spatie\StructureDiscoverer\Data\DiscoveredStructure;
use Spatie\StructureDiscoverer\Discover;
use Spatie\StructureDiscoverer\StructureScout;

final class BadgeStructureScout extends StructureScout
{
    public function cacheDriver(): DiscoverCacheDriver
    {
        return new LaravelDiscoverCacheDriver();
    }

    protected function definition(): Discover
    {
        return Discover::in(app_path('Badges'))
            ->classes()
            ->extending(AbstractBadge::class)
            ->custom(fn (DiscoveredStructure $structure) => $structure->name !== 'AbstractBadge')
            ->parallel();
    }
}
