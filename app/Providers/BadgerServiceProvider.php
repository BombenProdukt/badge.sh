<?php

declare(strict_types=1);

namespace App\Providers;

use App\Badger\Badger;
use App\Badger\Calculator\GDTextSizeCalculator;
use App\Badger\Contracts\TextSizeCalculator;
use App\Badger\BadgeRenderers\FlatSquareRender;
use App\Badger\BadgeRenderers\FlatSquareWithIconRender;
use App\Badger\BadgeRenderers\PlasticFlatRender;
use App\Badger\BadgeRenderers\PlasticRender;
use App\Badger\BadgeRenderers\SocialRender;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;

final class BadgerServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->registerCalculator();
        $this->registerBadger();
    }

    public function provides()
    {
        return [
            'badger',
            'badger.calculator',
        ];
    }

    protected function registerCalculator(): void
    {
        $this->app->singleton(TextSizeCalculator::class, GDTextSizeCalculator::class);
        $this->app->singleton('badger.calculator', TextSizeCalculator::class);
    }

    protected function registerBadger(): void
    {
        $this->app->singleton(Badger::class, function (Container $app) {
            $calculator = $app->make('badger.calculator');
            $path = \realpath($raw = resource_path('views/badger')) ?: $raw;

            return new Badger([
                new PlasticRender($calculator, $path),
                new PlasticFlatRender($calculator, $path),
                new FlatSquareRender($calculator, $path),
                new FlatSquareWithIconRender($calculator, $path),
                new SocialRender($calculator, $path),
            ]);
        });

        $this->app->singleton('badger', Badger::class);
    }
}
