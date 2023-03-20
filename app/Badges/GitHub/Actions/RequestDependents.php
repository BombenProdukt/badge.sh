<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Actions;

use Illuminate\Support\Facades\Http;
use PreemStudio\Formatter\FormatNumber;

final class RequestDependents
{
    public static function execute(string $owner, string $repo, string $type): array
    {
        $subject = $type === 'PACKAGE' ? 'pkg dependents' : 'repo dependents';
        $keyword = $type === 'PACKAGE' ? 'Packages' : 'Repositories';

        $html         = Http::get("https://github.com/{$owner}/{$repo}/network/dependents")->throw()->body();
        $reDependents = '/svg>\s*[\d,]+\s*'.preg_quote($keyword).'/';

        preg_match($reDependents, $html, $matches);
        $count = $matches[0] ? (int) preg_replace('/[^\d]/', '', $matches[0]) : 0;

        if ($count === 0) {
            return [
                'label'        => $subject,
                'message'      => 'invalid',
                'messageColor' => 'gray.600',
            ];
        }

        return [
            'label'        => $subject,
            'message'      => FormatNumber::execute($count),
            'messageColor' => 'blue.600',
        ];
    }
}