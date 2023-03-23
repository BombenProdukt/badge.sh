<?php

declare(strict_types=1);

namespace App\Badges\ROS;

use GrahamCampbell\GitHub\Facades\GitHub;
use Symfony\Component\Yaml\Yaml;

final class Client
{
    public function refs(string $distro): array
    {
        return GitHub::connection('graphql')->api('graphql')->execute(
            'query ($refPrefix: String!) { repository(owner: "ros", name: "rosdistro") { refs( refPrefix: $refPrefix first: 30 orderBy: { field: TAG_COMMIT_DATE, direction: DESC } ) { edges { node { name } } } } }',
            ['refPrefix' => "refs/tags/{$distro}/"],
        )['data']['repository']['refs']['edges'];
    }

    public function content(string $distro, string $ref): array
    {
        return Yaml::parse(GitHub::connection('graphql')->api('graphql')->execute(
            'query ($expression: String!) { repository(owner: "ros", name: "rosdistro") { object(expression: $expression) { ... on Blob { text } } } }',
            ['expression' => "{$ref}:{$distro}/distribution.yaml"],
        )['data']['repository']['object']['text']);
    }
}
