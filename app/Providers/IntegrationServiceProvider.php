<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

final class IntegrationServiceProvider extends ServiceProvider
{
    /**
     * The integration providers to register.
     *
     * @var array<string>
     */
    private static array $integrations = [
        \App\Integrations\AppVeyor\Provider::class,
        \App\Integrations\AtomPackage\Provider::class,
        \App\Integrations\AzurePipelines\Provider::class,
        \App\Integrations\Badge\Provider::class,
        \App\Integrations\Badgesize\Provider::class,
        \App\Integrations\Bundlephobia\Provider::class,
        \App\Integrations\ChromeWebStore\Provider::class,
        \App\Integrations\CircleCI\Provider::class,
        \App\Integrations\CocoaPods\Provider::class,
        \App\Integrations\Codacy\Provider::class,
        \App\Integrations\CodeClimate\Provider::class,
        \App\Integrations\Codecov\Provider::class,
        \App\Integrations\Coveralls\Provider::class,
        \App\Integrations\CPAN\Provider::class,
        \App\Integrations\CRAN\Provider::class,
        \App\Integrations\Crates\Provider::class,
        \App\Integrations\CTAN\Provider::class,
        \App\Integrations\DavidDM\Provider::class,
        \App\Integrations\DeepScan\Provider::class,
        \App\Integrations\Dependabot\Provider::class,
        \App\Integrations\DevRant\Provider::class,
        \App\Integrations\Discord\Provider::class,
        \App\Integrations\Docker\Provider::class,
        \App\Integrations\DUB\Provider::class,
        \App\Integrations\ElmPackage\Provider::class,
        \App\Integrations\FDroid\Provider::class,
        \App\Integrations\GitHub\Provider::class,
        \App\Integrations\GitLab\Provider::class,
        \App\Integrations\Gitter\Provider::class,
        \App\Integrations\Hackage\Provider::class,
        \App\Integrations\Haxelib\Provider::class,
        \App\Integrations\Homebrew\Provider::class,
        \App\Integrations\HTTPS\Provider::class,
        \App\Integrations\Jenkins\Provider::class,
        \App\Integrations\JSDelivr\Provider::class,
        \App\Integrations\Keybase\Provider::class,
        \App\Integrations\LGTM\Provider::class,
        \App\Integrations\Liberapay\Provider::class,
        \App\Integrations\Mastodon\Provider::class,
        \App\Integrations\Matrix\Provider::class,
        \App\Integrations\Maven\Provider::class,
        \App\Integrations\MELPA\Provider::class,
        \App\Integrations\Memo\Provider::class,
        \App\Integrations\MozillaAddOns\Provider::class,
        \App\Integrations\NPM\Provider::class,
        \App\Integrations\NuGet\Provider::class,
        \App\Integrations\OhDear\Provider::class,
        \App\Integrations\OPAM\Provider::class,
        \App\Integrations\OpenCollective\Provider::class,
        \App\Integrations\OpenVSX\Provider::class,
        \App\Integrations\PackagePhobia\Provider::class,
        \App\Integrations\Packagist\Provider::class,
        \App\Integrations\PeerTube\Provider::class,
        \App\Integrations\Pub\Provider::class,
        \App\Integrations\PyPI\Provider::class,
        \App\Integrations\Reddit\Provider::class,
        \App\Integrations\RubyGems\Provider::class,
        \App\Integrations\RunKit\Provider::class,
        \App\Integrations\Scoop\Provider::class,
        \App\Integrations\Shardbox\Provider::class,
        \App\Integrations\Snapcraft\Provider::class,
        \App\Integrations\Snyk\Provider::class,
        \App\Integrations\Tidelift\Provider::class,
        \App\Integrations\Travis\Provider::class,
        \App\Integrations\Twitter\Provider::class,
        \App\Integrations\UptimeRobot\Provider::class,
        \App\Integrations\VisualStudioMarketplace\Provider::class,
        \App\Integrations\WAPM\Provider::class,
        \App\Integrations\WinGet\Provider::class,
        \App\Integrations\XO\Provider::class,
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        Route::middleware('badge')->group(function (): void {
            foreach (IntegrationServiceProvider::$integrations as $integration) {
                app()->make($integration)->register();
            }
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }

    public static function examples(): array
    {
        $result = [];

        foreach (IntegrationServiceProvider::$integrations as $integration) {
            $integration = app()->make($integration);

            $result[$integration->name()] = $integration->examples();
        }

        return $result;
    }
}
