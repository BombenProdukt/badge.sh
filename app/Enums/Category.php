<?php

declare(strict_types=1);

namespace App\Enums;

enum Category: string
{
    case ACTIVITY         = 'activity';
    case ANALYSIS         = 'analysis';
    case BUILD            = 'build';
    case CHAT             = 'chat';
    case CODE_FORMATTING  = 'code-formatting';
    case COVERAGE         = 'coverage';
    case DEPENDENCIES     = 'dependencies';
    case DEVELOPMENT      = 'development';
    case DOWNLOADS        = 'downloads';
    case FUNDING          = 'funding';
    case ISSUE_TRACKING   = 'issue-tracking';
    case LICENSE          = 'license';
    case METRICS          = 'metrics';
    case MONITORING       = 'monitoring';
    case OTHER            = 'other';
    case PLATFORM_SUPPORT = 'platform-support';
    case RATING           = 'rating';
    case SIZE             = 'size';
    case SOCIAL           = 'social';
    case TEST_RESULTS     = 'test-results';
    case VERSION          = 'version';
}
