<?php

declare(strict_types=1);

namespace App\Integrations\Reddit\Controllers;

use App\Integrations\Actions\FormatNumber;
use App\Integrations\Reddit\Client;
use Illuminate\Routing\Controller;

final class CommentKarmaController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $user): array
    {
        return [
            'label'       => "u/{$user}",
            'status'      => FormatNumber::execute($this->client->get("user/{$user}/about.json")['comment_karma']).' comment karma',
            'statusColor' => 'ff4500',
        ];
    }
}
