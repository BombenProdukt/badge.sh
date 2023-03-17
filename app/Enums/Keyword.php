<?php

declare(strict_types=1);

namespace App\Enums;

enum Keyword: string
{
    case ACTIVITY         = 'activity';
    case ADMIN            = 'admin';
    case ADMIN_TOOLS      = 'admin-tools';
    case ANALYSIS         = 'analysis';
    case BUILD            = 'build';
    case CHAT             = 'chat';
    case CODE_STYLE       = 'code_style';
    case COVERAGE         = 'coverage';
    case DEPENDENCIES     = 'dependencies';
    case DOWNLOADS        = 'downloads';
    case ISSUE_TRACKING   = 'issue-tracking';
    case LICENSE          = 'license';
    case MONITORING       = 'monitoring';
    case OTHER            = 'other';
    case PLATFORM_SUPPORT = 'platform-support';
    case RATING           = 'rating';
    case SIZE             = 'size';
    case SOCIAL           = 'social';
    case VERSION          = 'version';
}
