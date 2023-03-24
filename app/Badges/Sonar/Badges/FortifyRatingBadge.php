<?php

declare(strict_types=1);

namespace App\Badges\Sonar\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Sonar\Client;
use App\Enums\Category;

final class FortifyRatingBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $metric, string $component, string $branch): array
    {
        $response = $this->client->get($this->getRequestData('instance'), $this->getRequestData('sonarVersion'), $metric, $component, $branch);

        return $this->renderPercentage('fortify security rating', $response['fortify-security-rating']);
    }

    public function service(): string
    {
        return 'Sonar';
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
            '/sonar/fortify-security-rating/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2' => 'complexity',
        ];
    }
}
