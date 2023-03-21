<?php

declare(strict_types=1);

namespace App\Badges\PyPI\Badges;

use App\Badges\AbstractBadge;
use App\Badges\PyPI\Client;
use App\Badges\Templates\TextTemplate;
use Illuminate\Routing\Route;

final class FormatBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $project): array
    {
        $urls     = $this->client->get($project)['urls'];
        $hasWheel = false;
        $hasEgg   = false;

        foreach ($urls as $url) {
            $packageType = $url['packagetype'];

            if (in_array($packageType, ['wheel', 'bdist_wheel'])) {
                $hasWheel = true;
            }

            if (in_array($packageType, ['egg', 'bdist_egg'])) {
                $hasEgg = true;
            }
        }

        if ($hasWheel) {
            return TextTemplate::make('format', 'wheel', 'green.600');
        }

        if ($hasEgg) {
            return TextTemplate::make('format', 'egg', 'red.600');
        }

        return TextTemplate::make('format', 'source', 'yellow.600');
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
        return [];
    }

    public function routePaths(): array
    {
        return [
            '/pypi/format/{project}',
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
            '/pypi/format/black' => 'format',
        ];
    }
}
