<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Facade;

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
    */

    'name' => env('APP_NAME', 'Laravel'),

    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services the application utilizes. Set this in your ".env" file.
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => (bool) env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | your application so that it is used when running Artisan tasks.
    |
    */

    'url' => env('APP_URL', 'http://localhost'),

    'asset_url' => env('ASSET_URL'),

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. We have gone
    | ahead and set this to a sensible default for you out of the box.
    |
    */

    'timezone' => 'UTC',

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by the translation service provider. You are free to set this value
    | to any of the locales which will be supported by the application.
    |
    */

    'locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Application Fallback Locale
    |--------------------------------------------------------------------------
    |
    | The fallback locale determines the locale to use when the current one
    | is not available. You may change the value to correspond to any of
    | the language folders that are provided through your application.
    |
    */

    'fallback_locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Faker Locale
    |--------------------------------------------------------------------------
    |
    | This locale will be used by the Faker PHP library when generating fake
    | data for your database seeds. For example, this will be used to get
    | localized telephone numbers, street address information and more.
    |
    */

    'faker_locale' => 'en_US',

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is used by the Illuminate encrypter service and should be set
    | to a random, 32 character string, otherwise these encrypted strings
    | will not be safe. Please do this before deploying an application!
    |
    */

    'key' => env('APP_KEY'),

    'cipher' => 'AES-256-CBC',

    /*
    |--------------------------------------------------------------------------
    | Maintenance Mode Driver
    |--------------------------------------------------------------------------
    |
    | These configuration options determine the driver used to determine and
    | manage Laravel's "maintenance mode" status. The "cache" driver will
    | allow maintenance mode to be controlled across multiple machines.
    |
    | Supported drivers: "file", "cache"
    |
    */

    'maintenance' => [
        'driver' => 'file',
        // 'store'  => 'redis',
    ],

    /*
    |--------------------------------------------------------------------------
    | Autoloaded Service Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded on the
    | request to your application. Feel free to add your own services to
    | this array to grant expanded functionality to your applications.
    |
    */

    'providers' => [

        /*
         * Laravel Framework Service Providers...
         */
        Illuminate\Auth\AuthServiceProvider::class,
        Illuminate\Broadcasting\BroadcastServiceProvider::class,
        Illuminate\Bus\BusServiceProvider::class,
        Illuminate\Cache\CacheServiceProvider::class,
        Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
        Illuminate\Cookie\CookieServiceProvider::class,
        Illuminate\Database\DatabaseServiceProvider::class,
        Illuminate\Encryption\EncryptionServiceProvider::class,
        Illuminate\Filesystem\FilesystemServiceProvider::class,
        Illuminate\Foundation\Providers\FoundationServiceProvider::class,
        Illuminate\Hashing\HashServiceProvider::class,
        Illuminate\Mail\MailServiceProvider::class,
        Illuminate\Notifications\NotificationServiceProvider::class,
        Illuminate\Pagination\PaginationServiceProvider::class,
        Illuminate\Pipeline\PipelineServiceProvider::class,
        Illuminate\Queue\QueueServiceProvider::class,
        Illuminate\Redis\RedisServiceProvider::class,
        Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
        Illuminate\Session\SessionServiceProvider::class,
        Illuminate\Translation\TranslationServiceProvider::class,
        Illuminate\Validation\ValidationServiceProvider::class,
        Illuminate\View\ViewServiceProvider::class,

        /*
         * Package Service Providers...
         */

        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        // App\Providers\BroadcastServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
        App\Providers\FortifyServiceProvider::class,
        App\Providers\JetstreamServiceProvider::class,
        App\Providers\IntegrationServiceProvider::class,

        /*
         * Badge Service Providers...
         */
        App\Badges\AppVeyor\BadgeServiceProvider::class,
        App\Badges\AtomPackage\BadgeServiceProvider::class,
        App\Badges\AzurePipelines\BadgeServiceProvider::class,
        App\Badges\Badge\BadgeServiceProvider::class,
        App\Badges\Badgesize\BadgeServiceProvider::class,
        App\Badges\Bundlephobia\BadgeServiceProvider::class,
        // App\Badges\ChromeWebStore\BadgeServiceProvider::class,
        App\Badges\CircleCI\BadgeServiceProvider::class,
        App\Badges\CocoaPods\BadgeServiceProvider::class,
        App\Badges\Codacy\BadgeServiceProvider::class,
        App\Badges\CodeClimate\BadgeServiceProvider::class,
        App\Badges\Codecov\BadgeServiceProvider::class,
        App\Badges\Coveralls\BadgeServiceProvider::class,
        App\Badges\CPAN\BadgeServiceProvider::class,
        App\Badges\CRAN\BadgeServiceProvider::class,
        App\Badges\Crates\BadgeServiceProvider::class,
        App\Badges\CTAN\BadgeServiceProvider::class,
        App\Badges\DavidDM\BadgeServiceProvider::class,
        App\Badges\DeepScan\BadgeServiceProvider::class,
        App\Badges\Dependabot\BadgeServiceProvider::class,
        App\Badges\DevRant\BadgeServiceProvider::class,
        App\Badges\Discord\BadgeServiceProvider::class,
        App\Badges\Docker\BadgeServiceProvider::class,
        App\Badges\DUB\BadgeServiceProvider::class,
        App\Badges\ElmPackage\BadgeServiceProvider::class,
        App\Badges\FDroid\BadgeServiceProvider::class,
        App\Badges\GitHub\BadgeServiceProvider::class,
        App\Badges\GitLab\BadgeServiceProvider::class,
        App\Badges\Gitter\BadgeServiceProvider::class,
        App\Badges\Hackage\BadgeServiceProvider::class,
        // App\Badges\Haxelib\BadgeServiceProvider::class,
        App\Badges\Homebrew\BadgeServiceProvider::class,
        App\Badges\HTTPS\BadgeServiceProvider::class,
        // App\Badges\Jenkins\BadgeServiceProvider::class,
        App\Badges\JSDelivr\BadgeServiceProvider::class,
        App\Badges\Keybase\BadgeServiceProvider::class,
        App\Badges\LGTM\BadgeServiceProvider::class,
        App\Badges\Liberapay\BadgeServiceProvider::class,
        App\Badges\Mastodon\BadgeServiceProvider::class,
        App\Badges\Matrix\BadgeServiceProvider::class,
        App\Badges\Maven\BadgeServiceProvider::class,
        App\Badges\MELPA\BadgeServiceProvider::class,
        // App\Badges\Memo\BadgeServiceProvider::class,
        App\Badges\MozillaAddOns\BadgeServiceProvider::class,
        App\Badges\NPM\BadgeServiceProvider::class,
        App\Badges\NuGet\BadgeServiceProvider::class,
        App\Badges\OhDear\BadgeServiceProvider::class,
        App\Badges\OPAM\BadgeServiceProvider::class,
        App\Badges\OpenCollective\BadgeServiceProvider::class,
        App\Badges\OpenVSX\BadgeServiceProvider::class,
        App\Badges\PackagePhobia\BadgeServiceProvider::class,
        App\Badges\Packagist\BadgeServiceProvider::class,
        App\Badges\PeerTube\BadgeServiceProvider::class,
        App\Badges\Pub\BadgeServiceProvider::class,
        App\Badges\PyPI\BadgeServiceProvider::class,
        App\Badges\Reddit\BadgeServiceProvider::class,
        App\Badges\RubyGems\BadgeServiceProvider::class,
        // App\Badges\RunKit\BadgeServiceProvider::class,
        App\Badges\Scoop\BadgeServiceProvider::class,
        App\Badges\Shardbox\BadgeServiceProvider::class,
        App\Badges\Snapcraft\BadgeServiceProvider::class,
        App\Badges\Snyk\BadgeServiceProvider::class,
        App\Badges\Tidelift\BadgeServiceProvider::class,
        App\Badges\Travis\BadgeServiceProvider::class,
        App\Badges\Twitter\BadgeServiceProvider::class,
        App\Badges\UptimeRobot\BadgeServiceProvider::class,
        App\Badges\VisualStudioMarketplace\BadgeServiceProvider::class,
        App\Badges\WAPM\BadgeServiceProvider::class,
        App\Badges\WinGet\BadgeServiceProvider::class,
        App\Badges\XO\BadgeServiceProvider::class,

    ],

    /*
    |--------------------------------------------------------------------------
    | Class Aliases
    |--------------------------------------------------------------------------
    |
    | This array of class aliases will be registered when this application
    | is started. However, feel free to register as many as you wish as
    | the aliases are "lazy" loaded so they don't hinder performance.
    |
    */

    'aliases' => Facade::defaultAliases()->merge([
        'BadgeService' => App\Facades\BadgeService::class,
    ])->toArray(),

];
