<?php

declare(strict_types=1);

namespace App\Badges\WinGet\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;
use Symfony\Component\Yaml\Yaml;

final class LicenseBadge extends AbstractBadge
{
    public function handle(string $appId): array
    {
        $document = Yaml::parse(base64_decode($this->client->get($appId)['content']));
        $document = Yaml::parse(base64_decode($this->client->locale($appId, $document['PackageVersion'], $document['DefaultLocale'])['content']));

        return $this->renderLicense($document['License']);
    }

    public function keywords(): array
    {
        return [Category::LICENSE];
    }

    public function routePaths(): array
    {
        return [
            '/winget/license/{appId}',
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
            '/winget/license/GitHub.cli' => 'license',
        ];
    }
}
