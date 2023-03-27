<?php

declare(strict_types=1);

namespace App\Badges\Sonar\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class GenericBadge extends AbstractBadge
{
    protected string $route = '/sonar/{metric}/{component}/{branch}';

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $metric, string $component, string $branch): array
    {
        return [
            'metric' => $metric,
            'value' => $this->client->get($this->getRequestData('instance'), $this->getRequestData('sonarVersion'), $metric, $component, $branch)[$metric],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber(\str_replace('_', '', $properties['metric']), $properties['value']);
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
            'blocker_issues',
            'branch_coverage_hits_data',
            'branch_coverage',
            'bugs',
            'classes',
            'code_smells',
            'cognitive_complexity',
            'comment_lines_density',
            'comment_lines',
            'complexity',
            'conditions_by_line',
            'confirmed_issues',
            'coverage_line_hits_data',
            'covered_conditions_by_line',
            'critical_issues',
            'directories',
            'duplicated_blocks',
            'duplicated_files',
            'duplicated_lines_density',
            'duplicated_lines',
            'false_positive_issues',
            'files',
            'info_issues',
            'line_coverage',
            'lines_to_cover',
            'lines',
            'major_issues',
            'minor_issues',
            'new_blocker_violations',
            'new_branch_coverage',
            'new_bugs',
            'new_code_smells',
            'new_coverage',
            'new_critical_violations',
            'new_info_violations',
            'new_line_coverage',
            'new_lines_to_cover',
            'new_major_violations',
            'new_minor_violations',
            'new_reliability_remediation_effort',
            'new_security_remediation_effort',
            'new_sqale_debt_ratio',
            'new_technical_debt',
            'new_uncovered_conditions',
            'new_uncovered_lines',
            'new_violations',
            'new_vulnerabilities',
            'nloc',
            'open_issues',
            'projects',
            'reliability_rating',
            'reliability_remediation_effort',
            'reopened_issues',
            'security_rating',
            'security_remediation_effort',
            'sqale_index',
            'sqale_index',
            'sqale_rating',
            'statements',
            'uncovered_conditions',
            'uncovered_lines',
            'vulnerabilities',
        ]);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'blocker issues',
                path: '/sonar/blocker_issues/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['metric' => 'blocker_issues', 'value' => 0]),
            ),
            new BadgePreviewData(
                name: 'branch coverage hits data',
                path: '/sonar/branch_coverage_hits_data/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['metric' => 'branch_coverage_hits_data', 'value' => 0]),
            ),
            new BadgePreviewData(
                name: 'branch coverage',
                path: '/sonar/branch_coverage/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['metric' => 'branch_coverage', 'value' => 0]),
            ),
            new BadgePreviewData(
                name: 'bugs',
                path: '/sonar/bugs/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['metric' => 'bugs', 'value' => 0]),
            ),
            new BadgePreviewData(
                name: 'classes',
                path: '/sonar/classes/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['metric' => 'classes', 'value' => 0]),
            ),
            new BadgePreviewData(
                name: 'code smells',
                path: '/sonar/code_smells/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['metric' => 'code_smells', 'value' => 0]),
            ),
            new BadgePreviewData(
                name: 'cognitive complexity',
                path: '/sonar/cognitive_complexity/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['metric' => 'cognitive_complexity', 'value' => 0]),
            ),
            new BadgePreviewData(
                name: 'comment lines density',
                path: '/sonar/comment_lines_density/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['metric' => 'comment_lines_density', 'value' => 0]),
            ),
            new BadgePreviewData(
                name: 'comment lines',
                path: '/sonar/comment_lines/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['metric' => 'comment_lines', 'value' => 0]),
            ),
            new BadgePreviewData(
                name: 'complexity',
                path: '/sonar/complexity/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['metric' => 'complexity', 'value' => 0]),
            ),
            new BadgePreviewData(
                name: 'conditions by line',
                path: '/sonar/conditions_by_line/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['metric' => 'conditions_by_line', 'value' => 0]),
            ),
            new BadgePreviewData(
                name: 'confirmed issues',
                path: '/sonar/confirmed_issues/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['metric' => 'confirmed_issues', 'value' => 0]),
            ),
            new BadgePreviewData(
                name: 'coverage line hits data',
                path: '/sonar/coverage_line_hits_data/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['metric' => 'coverage_line_hits_data', 'value' => 0]),
            ),
            new BadgePreviewData(
                name: 'covered conditions by line',
                path: '/sonar/covered_conditions_by_line/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['metric' => 'covered_conditions_by_line', 'value' => 0]),
            ),
            new BadgePreviewData(
                name: 'critical issues',
                path: '/sonar/critical_issues/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['metric' => 'critical_issues', 'value' => 0]),
            ),
            new BadgePreviewData(
                name: 'directories',
                path: '/sonar/directories/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['metric' => 'directories', 'value' => 0]),
            ),
            new BadgePreviewData(
                name: 'duplicated blocks',
                path: '/sonar/duplicated_blocks/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['metric' => 'duplicated_blocks', 'value' => 0]),
            ),
            new BadgePreviewData(
                name: 'duplicated files',
                path: '/sonar/duplicated_files/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['metric' => 'duplicated_files', 'value' => 0]),
            ),
            new BadgePreviewData(
                name: 'duplicated lines density',
                path: '/sonar/duplicated_lines_density/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['metric' => 'duplicated_lines_density', 'value' => 0]),
            ),
            new BadgePreviewData(
                name: 'duplicated lines',
                path: '/sonar/duplicated_lines/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['metric' => 'duplicated_lines', 'value' => 0]),
            ),
            new BadgePreviewData(
                name: 'false positive issues',
                path: '/sonar/false_positive_issues/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['metric' => 'false_positive_issues', 'value' => 0]),
            ),
            new BadgePreviewData(
                name: 'files',
                path: '/sonar/files/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['metric' => 'files', 'value' => 0]),
            ),
            new BadgePreviewData(
                name: 'info issues',
                path: '/sonar/info_issues/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['metric' => 'info_issues', 'value' => 0]),
            ),
            new BadgePreviewData(
                name: 'line coverage',
                path: '/sonar/line_coverage/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['metric' => 'line_coverage', 'value' => 0]),
            ),
            new BadgePreviewData(
                name: 'lines to cover',
                path: '/sonar/lines_to_cover/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['metric' => 'lines_to_cover', 'value' => 0]),
            ),
            new BadgePreviewData(
                name: 'lines',
                path: '/sonar/lines/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['metric' => 'lines', 'value' => 0]),
            ),
            new BadgePreviewData(
                name: 'major issues',
                path: '/sonar/major_issues/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['metric' => 'major_issues', 'value' => 0]),
            ),
            new BadgePreviewData(
                name: 'minor issues',
                path: '/sonar/minor_issues/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['metric' => 'minor_issues', 'value' => 0]),
            ),
            new BadgePreviewData(
                name: 'new blocker violations',
                path: '/sonar/new_blocker_violations/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['metric' => 'new_blocker_violations', 'value' => 0]),
            ),
            new BadgePreviewData(
                name: 'new branch coverage',
                path: '/sonar/new_branch_coverage/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['metric' => 'new_branch_coverage', 'value' => 0]),
            ),
            new BadgePreviewData(
                name: 'new bugs',
                path: '/sonar/new_bugs/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['metric' => 'new_bugs', 'value' => 0]),
            ),
            new BadgePreviewData(
                name: 'new code smells',
                path: '/sonar/new_code_smells/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['metric' => 'new_code_smells', 'value' => 0]),
            ),
            new BadgePreviewData(
                name: 'new coverage',
                path: '/sonar/new_coverage/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['metric' => 'new_coverage', 'value' => 0]),
            ),
            new BadgePreviewData(
                name: 'new critical violations',
                path: '/sonar/new_critical_violations/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['metric' => 'new_critical_violations', 'value' => 0]),
            ),
            new BadgePreviewData(
                name: 'new info violations',
                path: '/sonar/new_info_violations/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['metric' => 'new_info_violations', 'value' => 0]),
            ),
            new BadgePreviewData(
                name: 'new line coverage',
                path: '/sonar/new_line_coverage/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['metric' => 'new_line_coverage', 'value' => 0]),
            ),
            new BadgePreviewData(
                name: 'new lines to cover',
                path: '/sonar/new_lines_to_cover/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['metric' => 'new_lines_to_cover', 'value' => 0]),
            ),
            new BadgePreviewData(
                name: 'new major violations',
                path: '/sonar/new_major_violations/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['metric' => 'new_major_violations', 'value' => 0]),
            ),
            new BadgePreviewData(
                name: 'new minor violations',
                path: '/sonar/new_minor_violations/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['metric' => 'new_minor_violations', 'value' => 0]),
            ),
            new BadgePreviewData(
                name: 'new reliability remediation effort',
                path: '/sonar/new_reliability_remediation_effort/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['metric' => 'new_reliability_remediation_effort', 'value' => 0]),
            ),
            new BadgePreviewData(
                name: 'new security remediation effort',
                path: '/sonar/new_security_remediation_effort/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['metric' => 'new_security_remediation_effort', 'value' => 0]),
            ),
            new BadgePreviewData(
                name: 'new sqale debt ratio',
                path: '/sonar/new_sqale_debt_ratio/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['metric' => 'new_sqale_debt_ratio', 'value' => 0]),
            ),
            new BadgePreviewData(
                name: 'new technical debt',
                path: '/sonar/new_technical_debt/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['metric' => 'new_technical_debt', 'value' => 0]),
            ),
            new BadgePreviewData(
                name: 'new uncovered conditions',
                path: '/sonar/new_uncovered_conditions/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['metric' => 'new_uncovered_conditions', 'value' => 0]),
            ),
            new BadgePreviewData(
                name: 'new uncovered lines',
                path: '/sonar/new_uncovered_lines/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['metric' => 'new_uncovered_lines', 'value' => 0]),
            ),
            new BadgePreviewData(
                name: 'new violations',
                path: '/sonar/new_violations/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['metric' => 'new_violations', 'value' => 0]),
            ),
            new BadgePreviewData(
                name: 'new vulnerabilities',
                path: '/sonar/new_vulnerabilities/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['metric' => 'new_vulnerabilities', 'value' => 0]),
            ),
            new BadgePreviewData(
                name: 'nloc',
                path: '/sonar/nloc/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['metric' => 'nloc', 'value' => 0]),
            ),
            new BadgePreviewData(
                name: 'open issues',
                path: '/sonar/open_issues/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['metric' => 'open_issues', 'value' => 0]),
            ),
            new BadgePreviewData(
                name: 'projects',
                path: '/sonar/projects/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['metric' => 'projects', 'value' => 0]),
            ),
            new BadgePreviewData(
                name: 'reliability rating',
                path: '/sonar/reliability_rating/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['metric' => 'reliability_rating', 'value' => 0]),
            ),
            new BadgePreviewData(
                name: 'reliability remediation effort',
                path: '/sonar/reliability_remediation_effort/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['metric' => 'reliability_remediation_effort', 'value' => 0]),
            ),
            new BadgePreviewData(
                name: 'reopened issues',
                path: '/sonar/reopened_issues/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['metric' => 'reopened_issues', 'value' => 0]),
            ),
            new BadgePreviewData(
                name: 'security rating',
                path: '/sonar/security_rating/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['metric' => 'security_rating', 'value' => 0]),
            ),
            new BadgePreviewData(
                name: 'security remediation effort',
                path: '/sonar/security_remediation_effort/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['metric' => 'security_remediation_effort', 'value' => 0]),
            ),
            new BadgePreviewData(
                name: 'sqale index',
                path: '/sonar/sqale_index/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['metric' => 'sqale_index', 'value' => 0]),
            ),
            new BadgePreviewData(
                name: 'sqale index',
                path: '/sonar/sqale_index/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['metric' => 'sqale_index', 'value' => 0]),
            ),
            new BadgePreviewData(
                name: 'sqale rating',
                path: '/sonar/sqale_rating/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['metric' => 'sqale_rating', 'value' => 0]),
            ),
            new BadgePreviewData(
                name: 'statements',
                path: '/sonar/statements/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['metric' => 'statements', 'value' => 0]),
            ),
            new BadgePreviewData(
                name: 'uncovered conditions',
                path: '/sonar/uncovered_conditions/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['metric' => 'uncovered_conditions', 'value' => 0]),
            ),
            new BadgePreviewData(
                name: 'uncovered lines',
                path: '/sonar/uncovered_lines/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['metric' => 'uncovered_lines', 'value' => 0]),
            ),
            new BadgePreviewData(
                name: 'vulnerabilities',
                path: '/sonar/vulnerabilities/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2',
                data: $this->render(['metric' => 'vulnerabilities', 'value' => 0]),
            ),
        ];
    }
}
