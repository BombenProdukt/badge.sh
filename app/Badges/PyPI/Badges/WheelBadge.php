<?php

declare(strict_types=1);

namespace App\Badges\PyPI\Badges;

use App\Badges\AbstractBadge;
use App\Badges\PyPI\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class WheelBadge extends AbstractBadge
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

    public function keywords(): array
    {
        return [Category::PLATFORM_SUPPORT];
    }

    public function routePaths(): array
    {
        return [
            '/pypi/wheel/{project}',
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
            '/pypi/wheel/black' => 'wheel',
        ];
    }
}