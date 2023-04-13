<?php

declare(strict_types=1);

namespace App\Badges\Sonar;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class ViolationsBadge extends AbstractBadge
{
    protected string $route = '/sonar/{metric}/{component}/{branch}';

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $metric, string $component, string $branch): array
    {
        $response = $this->client->get($this->getRequestData('instance'), $this->getRequestData('sonarVersion'), $metric, $component, $branch);

        return [
            'total' => $response['violations'],
            'info' => $response['violations']['info_violations'],
            'minor' => $response['violations']['minor_violations'],
            'major' => $response['violations']['major_violations'],
            'critical' => $response['violations']['critical_violations'],
            'blocker' => $response['violations']['blocker_violations'],
        ];
    }

    public function render(array $properties): array
    {
        if ($properties['total'] === 0) {
            return $this->renderNumber('violations', 0);
        }

        $color = null;
        $violationSummary = [];

        if ($properties['info'] > 0) {
            $violationSummary[] = $properties['info'].' info';
            $color = 'green.600';
        }

        if ($properties['minor'] > 0) {
            $violationSummary[] = $properties['minor'].' minor';
            $color = 'yellow.600';
        }

        if ($properties['major'] > 0) {
            $violationSummary[] = $properties['major'].' major';
            $color = 'amber.600';
        }

        if ($properties['critical'] > 0) {
            $violationSummary[] = $properties['critical'].' critical';
            $color = 'orange.600';
        }

        if ($properties['blocker'] > 0) {
            $violationSummary[] = $properties['blocker'].' blocker';
            $color = 'red.600';
        }

        return $this->renderText('violations', \implode(', ', $violationSummary), $color);
    }

    public function routeRules(): array
    {
        return [
            'instance' => ['required', 'url'],
            'sonarVersion' => ['required', 'numeric'],
        ];
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

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'complexity',
                path: '/sonar/blocker_violations/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render([
                    'total' => 0,
                    'info' => 0,
                    'minor' => 0,
                    'major' => 0,
                    'critical' => 0,
                    'blocker' => 0,
                ]),
            ),
            new BadgePreviewData(
                name: 'cognitive complexity',
                path: '/sonar/critical_violations/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render([
                    'total' => 0,
                    'info' => 0,
                    'minor' => 0,
                    'major' => 0,
                    'critical' => 0,
                    'blocker' => 0,
                ]),
            ),
            new BadgePreviewData(
                name: 'duplicated blocks',
                path: '/sonar/info_violations/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render([
                    'total' => 0,
                    'info' => 0,
                    'minor' => 0,
                    'major' => 0,
                    'critical' => 0,
                    'blocker' => 0,
                ]),
            ),
            new BadgePreviewData(
                name: 'duplicated files',
                path: '/sonar/major_violations/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render([
                    'total' => 0,
                    'info' => 0,
                    'minor' => 0,
                    'major' => 0,
                    'critical' => 0,
                    'blocker' => 0,
                ]),
            ),
            new BadgePreviewData(
                name: 'duplicated lines',
                path: '/sonar/minor_violations/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render([
                    'total' => 0,
                    'info' => 0,
                    'minor' => 0,
                    'major' => 0,
                    'critical' => 0,
                    'blocker' => 0,
                ]),
            ),
            new BadgePreviewData(
                name: 'duplicated lines density',
                path: '/sonar/violations/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render([
                    'total' => 0,
                    'info' => 0,
                    'minor' => 0,
                    'major' => 0,
                    'critical' => 0,
                    'blocker' => 0,
                ]),
            ),
        ];
    }
}
