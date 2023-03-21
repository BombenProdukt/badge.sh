<?php

declare(strict_types=1);

namespace App\Badges\PyPI\Badges;

use App\Badges\PyPI\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class WheelsBadge implements Badge
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

        return [
            'label'        => 'wheel',
            'message'      => $hasWheel ? 'yes' : 'no',
            'messageColor' => $hasWheel ? 'green.600' : 'red.600',
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
            '/pypi/wheels/{project}',
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
            '/pypi/wheels/black' => 'wheels',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
