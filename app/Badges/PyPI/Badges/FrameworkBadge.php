<?php

declare(strict_types=1);

namespace App\Badges\PyPI\Badges;

use App\Badges\PyPI\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class FrameworkBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $project): array
    {
        $frameworks = collect($this->client->get($project)['info']['classifiers'])->map(function (string $classifier) {
            if (! str_starts_with($classifier, 'Framework ::')) {
                return null;
            }

            $classifier = explode(' :: ', $classifier);

            return ['framework' => $classifier[1], 'version' => $classifier[2] ?? null];
        })->filter();

        return [
            'label'        => $frameworks->first()['framework'],
            'message'      => $frameworks->map->version->filter()->implode(' | '),
            'messageColor' => 'blue.600',
        ];
    }

    public function service(): string
    {
        return 'PyPI';
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
            '/pypi/framework/{project}',
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
            '/pypi/framework/black'       => 'framework',
            '/pypi/framework/plone.volto' => 'framework',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
