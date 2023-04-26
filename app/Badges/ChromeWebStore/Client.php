<?php

declare(strict_types=1);

namespace App\Badges\ChromeWebStore;

use Illuminate\Support\Facades\Process;

final class Client
{
    public function get(string $itemId): string
    {
        $node = '/usr/bin/node';
        $script = base_path('scripts/chrome-web-store.mjs');

        return Process::run("{$node} {$script} {$itemId}")->throw()->output();
    }
}
