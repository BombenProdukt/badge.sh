<?php

declare(strict_types=1);

namespace App\Badges\ElmPackage\Badges;

use App\Badges\AbstractBadge;
use App\Badges\ElmPackage\Client;
use App\Badges\Templates\VersionTemplate;
use Illuminate\Routing\Route;

final class ElmVersionBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $project): array
    {
        $version = $this->formatElmVersion($this->client->get($project)['elm-version']);

        return VersionTemplate::make($this->service(), $version);
    }

    public function service(): string
    {
        return 'Elm Package';
    }

    public function title(): string
    {
        return '';
    }

    public function keywords(): array
    {
        return [];
    }

    public function routePaths(): array
    {
        return [
            '/elm-package/elm-version/{project}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/elm-package/elm-version/justinmimbs/date' => 'elm version',
        ];
    }

    private function formatElmVersion(string $range): string
    {
        $parts = preg_split('/\s+/', $range);
        $parts = array_filter($parts, fn ($it) => $it !== 'v');

        if (count($parts) === 1) {
            return $parts[0];
        }

        [$lower, $lowerOp, $upperOp, $upper] = array_values($parts);
        $lowerOp                             = preg_replace('/^</', '>', $lowerOp);

        return "{$lowerOp}{$lower} {$upperOp}{$upper}";
    }
}
