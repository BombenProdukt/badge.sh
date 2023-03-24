<?php

declare(strict_types=1);

namespace App\Badges\Sonar\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;
use Illuminate\Support\Str;

final class GenericBadge extends AbstractBadge
{
    public function handle(string $metric, string $component, string $branch): array
    {
        $response = $this->client->get($this->getRequestData('instance'), $this->getRequestData('sonarVersion'), $metric, $component, $branch);

        return $this->renderNumber(Str::of($metric)->title()->lower()->toString(), $response[$metric]);
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

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/sonar/blocker_issues/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'                     => 'blocker issues',
            '/sonar/branch_coverage_hits_data/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'          => 'branch coverage hits data',
            '/sonar/branch_coverage/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'                    => 'branch coverage',
            '/sonar/bugs/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'                               => 'bugs',
            '/sonar/classes/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'                            => 'classes',
            '/sonar/code_smells/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'                        => 'code smells',
            '/sonar/cognitive_complexity/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'               => 'cognitive complexity',
            '/sonar/comment_lines_density/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'              => 'comment lines density',
            '/sonar/comment_lines/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'                      => 'comment lines',
            '/sonar/complexity/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'                         => 'complexity',
            '/sonar/conditions_by_line/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'                 => 'conditions by line',
            '/sonar/confirmed_issues/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'                   => 'confirmed issues',
            '/sonar/coverage_line_hits_data/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'            => 'coverage line hits data',
            '/sonar/covered_conditions_by_line/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'         => 'covered conditions by line',
            '/sonar/critical_issues/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'                    => 'critical issues',
            '/sonar/directories/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'                        => 'directories',
            '/sonar/duplicated_blocks/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'                  => 'duplicated blocks',
            '/sonar/duplicated_files/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'                   => 'duplicated files',
            '/sonar/duplicated_lines_density/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'           => 'duplicated lines density',
            '/sonar/duplicated_lines/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'                   => 'duplicated lines',
            '/sonar/false_positive_issues/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'              => 'false positive issues',
            '/sonar/files/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'                              => 'files',
            '/sonar/info_issues/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'                        => 'info issues',
            '/sonar/line_coverage/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'                      => 'line coverage',
            '/sonar/lines_to_cover/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'                     => 'lines to cover',
            '/sonar/lines/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'                              => 'lines',
            '/sonar/major_issues/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'                       => 'major issues',
            '/sonar/minor_issues/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'                       => 'minor issues',
            '/sonar/new_blocker_violations/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'             => 'new blocker violations',
            '/sonar/new_branch_coverage/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'                => 'new branch coverage',
            '/sonar/new_bugs/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'                           => 'new bugs',
            '/sonar/new_code_smells/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'                    => 'new code smells',
            '/sonar/new_coverage/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'                       => 'new coverage',
            '/sonar/new_critical_violations/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'            => 'new critical violations',
            '/sonar/new_info_violations/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'                => 'new info violations',
            '/sonar/new_line_coverage/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'                  => 'new line coverage',
            '/sonar/new_lines_to_cover/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'                 => 'new lines to cover',
            '/sonar/new_major_violations/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'               => 'new major violations',
            '/sonar/new_minor_violations/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'               => 'new minor violations',
            '/sonar/new_reliability_remediation_effort/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2' => 'new reliability remediation effort',
            '/sonar/new_security_remediation_effort/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'    => 'new security remediation effort',
            '/sonar/new_sqale_debt_ratio/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'               => 'new sqale debt ratio',
            '/sonar/new_technical_debt/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'                 => 'new technical debt',
            '/sonar/new_uncovered_conditions/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'           => 'new uncovered conditions',
            '/sonar/new_uncovered_lines/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'                => 'new uncovered lines',
            '/sonar/new_violations/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'                     => 'new violations',
            '/sonar/new_vulnerabilities/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'                => 'new vulnerabilities',
            '/sonar/nloc/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'                               => 'nloc',
            '/sonar/open_issues/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'                        => 'open issues',
            '/sonar/projects/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'                           => 'projects',
            '/sonar/reliability_rating/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'                 => 'reliability rating',
            '/sonar/reliability_remediation_effort/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'     => 'reliability remediation effort',
            '/sonar/reopened_issues/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'                    => 'reopened issues',
            '/sonar/security_rating/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'                    => 'security rating',
            '/sonar/security_remediation_effort/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'        => 'security remediation effort',
            '/sonar/sqale_index/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'                        => 'sqale index',
            '/sonar/sqale_index/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'                        => 'sqale index',
            '/sonar/sqale_rating/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'                       => 'sqale rating',
            '/sonar/statements/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'                         => 'statements',
            '/sonar/uncovered_conditions/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'               => 'uncovered conditions',
            '/sonar/uncovered_lines/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'                    => 'uncovered lines',
            '/sonar/vulnerabilities/org.ow2.petals:petals-se-ase/master?instance=http://sonar.petalslink.com&sonarVersion=4.2'                    => 'vulnerabilities',
        ];
    }
}
