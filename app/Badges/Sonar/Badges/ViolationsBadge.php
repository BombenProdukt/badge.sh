<?php

declare(strict_types=1);

namespace App\Badges\Sonar\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Sonar\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class ViolationsBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $metric, string $component, string $branch): array
    {
        $violations = $this->client->get($this->getRequestData('instance'), $this->getRequestData('sonarVersion'), $metric, $component, $branch)['violations'];

        if ($violations === 0) {
            return $this->renderNumber('violations', 0);
        }

        $color            = null;
        $violationSummary = [];

        if ($violations['info_violations'] > 0) {
            $violationSummary[] = $violations['info_violations'].' info';
            $color              = 'green.600';
        }

        if ($violations['minor_violations'] > 0) {
            $violationSummary[] = $violations['minor_violations'].' minor';
            $color              = 'yellow.600';
        }

        if ($violations['major_violations'] > 0) {
            $violationSummary[] = $violations['major_violations'].' major';
            $color              = 'amber.600';
        }

        if ($violations['critical_violations'] > 0) {
            $violationSummary[] = $violations['critical_violations'].' critical';
            $color              = 'orange.600';
        }

        if ($violations['blocker_violations'] > 0) {
            $violationSummary[] = $violations['blocker_violations'].' blocker';
            $color              = 'red.600';
        }

        return $this->renderText('violations', implode(', ', $violationSummary), $color);
    }

    public function service(): string
    {
        return 'Sonar';
    }

    public function keywords(): array
    {
        return [Category::ANALYSIS];
    }

    public function routePaths(): array
    {
        return [
            '/sonar/{metric}/{component}/{branch}',
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

    public function routeConstraints(Route $route): void
    {
        $route->whereIn('metric', [
            'blocker_violations',
            'critical_violations',
            'info_violations',
            'major_violations',
            'minor_violations',
            'violations',
        ]);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/sonar/blocker_violations/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'  => 'complexity',
            '/sonar/critical_violations/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2' => 'cognitive complexity',
            '/sonar/info_violations/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'     => 'duplicated blocks',
            '/sonar/major_violations/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'    => 'duplicated files',
            '/sonar/minor_violations/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'    => 'duplicated lines',
            '/sonar/violations/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'          => 'duplicated lines density',
        ];
    }
}
