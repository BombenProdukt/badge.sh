<?php

declare(strict_types=1);

namespace App\Badges\Sonar\Badges;

use App\Enums\Category;

final class FortifyRatingBadge extends AbstractBadge
{
    public function handle(string $metric, string $component, string $branch): array
    {
        return [
            'rating' => $this->client->get($this->getRequestData('instance'), $this->getRequestData('sonarVersion'), $metric, $component, $branch)['fortify-security-rating'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderPercentage('fortify security rating', $properties['rating']);
    }

    public function keywords(): array
    {
        return [Category::COVERAGE];
    }

    public function routePaths(): array
    {
        return [
            '/sonar/fortify-security-rating/{component}/{branch}',
        ];
    }

    public function routeRules(): array
    {
        return [
            'instance' => ['required', 'url'],
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
            '/sonar/fortify-security-rating/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2' => 'complexity',
        ];
    }
}
