<?php

declare(strict_types=1);

namespace App\Badges\Jira;

use Illuminate\Support\Facades\Http;

final class Client
{
    public function issue(string $instance, string $issue): array
    {
        return Http::baseUrl($instance)->throw()->get("rest/api/2/issue/{$issue}")->json('fields.status');
    }

    public function sprint(string $instance, string $sprint): array
    {
        return Http::baseUrl($instance)->throw()->get('rest/api/2/search', [
            'jql'        => 'sprint='.$sprint.' AND type IN (Bug,Improvement,Story,"Technical task")',
            'fields'     => 'resolution',
            'maxResults' => 500,
        ])->json();
    }
}
