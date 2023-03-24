<?php

declare(strict_types=1);

namespace App\Badges\Sonar\Badges;

use App\Enums\Category;

final class DocumentApiDensityBadge extends AbstractBadge
{
    public function handle(string $metric, string $component, string $branch): array
    {
        $response = $this->client->get($this->getRequestData('instance'), $this->getRequestData('sonarVersion'), $metric, $component, $branch);

        return $this->renderPercentage('public documented api density', $response['public_documented_api_density']);
    }

    public function keywords(): array
    {
        return [Category::ANALYSIS];
    }

    public function routePaths(): array
    {
        return [
            '/sonar/public_documented_api_density/{component}/{branch}',
        ];
    }

    public function routeRules(): array
    {
        return [
            'instance'     => ['required', 'url'],
            'sonarVersion' => ['required', 'numeric'],
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/sonar/public_documented_api_density/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2' => 'complexity',
        ];
    }
}
