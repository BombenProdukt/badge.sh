<?php

declare(strict_types=1);

namespace App\Badges\Endpoint;

use App\Facades\BadgeService;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use SimpleXMLElement;
use Symfony\Component\Yaml\Yaml;

final class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        BadgeService::add(Badges\JSONBadge::class);
        BadgeService::add(Badges\XMLBadge::class);
        BadgeService::add(Badges\YAMLBadge::class);

        Route::get('/endpoint/demo/json', fn () => [
            'schemaVersion' => 1,
            'label' => 'is it monday',
            'message' => 'no',
            'messageColor' => 'orange.600',
        ])->name('services.endpoint.json');

        Route::get('/endpoint/demo/xml', function () {
            $xml = new SimpleXMLElement('<root/>');
            $xml->addChild('schemaVersion', '1');
            $xml->addChild('label', 'is it monday');
            $xml->addChild('message', 'no');
            $xml->addChild('messageColor', 'orange.600');

            return $xml->asXML();
        })->name('services.endpoint.xml');

        Route::get('/endpoint/demo/yaml', fn () => Yaml::dump([
            'schemaVersion' => 1,
            'label' => 'is it monday',
            'message' => 'no',
            'messageColor' => 'orange.600',
        ]))->name('services.endpoint.yaml');
    }
}
