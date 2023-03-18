<?php

declare(strict_types=1);

namespace App\Badges\ElmPackage\Badges;

use App\Actions\ExtractVersion;
use App\Actions\ExtractVersionColor;
use App\Badges\ElmPackage\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class ElmVersionBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $owner, string $name): array
    {
        $version = $this->formatElmVersion($this->client->get($owner, $name)['elm-version']);

        return [
            'label'        => 'elm',
            'status'       => ExtractVersion::execute($version),
            'statusColor'  => ExtractVersionColor::execute($version),
        ];
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
        return [
            //
        ];
    }

    public function routePaths(): array
    {
        return [
            '/elm-package/elm/{owner}/{name}',
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
            '/elm-package/elm/justinmimbs/date' => 'elm version',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
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
