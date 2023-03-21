<?php

declare(strict_types=1);

namespace App\Badges\NuGet\Badges;

use App\Badges\AbstractBadge;
use App\Badges\NuGet\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Http;

final class TotalDownloadsBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $project): array
    {
        $totalDownloads = Http::get('https://azuresearch-usnc.nuget.org/query', [
            'q'           => 'packageid:'.strtolower($project),
            'prerelease'  => 'true',
            'semVerLevel' => 2,
        ])->throw()->json('data.0.totalDownloads');

        return $this->renderDownloads($totalDownloads);
    }

    public function service(): string
    {
        return 'NuGet';
    }

    public function title(): string
    {
        return '';
    }

    public function keywords(): array
    {
        return [Category::DOWNLOADS];
    }

    public function routePaths(): array
    {
        return [
            '/nuget/downloads/{project}',
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
            '/nuget/downloads/Newtonsoft.Json' => 'total downloads',
        ];
    }
}
