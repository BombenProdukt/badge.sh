<?php

declare(strict_types=1);

namespace App\Providers;

use App\Badger\Badger;
use App\Badger\Calculator\GDTextSizeCalculator;
use App\Badger\Calculator\TextSizeCalculatorInterface;
use App\Badger\Render\FlatSquareRender;
use App\Badger\Render\FlatSquareWithIconRender;
use App\Badger\Render\PlasticFlatRender;
use App\Badger\Render\PlasticRender;
use App\Badger\Render\SocialRender;
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
        $this->app->singleton(TextSizeCalculatorInterface::class, fn () => new GDTextSizeCalculator());

        $this->app->singleton('badger.calculator', TextSizeCalculatorInterface::class);
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
