<?php

declare(strict_types=1);

namespace App\Badges\Concerns;

use App\Actions\DetermineColorByAge;
use App\Actions\DetermineColorByGrade;
use App\Actions\DetermineColorByPercentage;
use App\Actions\DetermineColorByStatus;
use App\Actions\DetermineColorByVersion;
use App\Actions\DetermineLicense;
use App\Actions\ExtractVersion;
use Carbon\Carbon;
use PreemStudio\Formatter\FormatBytes;
use PreemStudio\Formatter\FormatMoney;
use PreemStudio\Formatter\FormatNumber;
use PreemStudio\Formatter\FormatPercentage;
use Throwable;

trait HasTemplates
{
    protected function renderCoverage(mixed $percentage, ?string $label = null): array
    {
        return $this->renderPercentage($label ?? 'coverage', $percentage);
    }

    protected function renderDate(string $label, mixed $value): array
    {
        try {
            $carbon = Carbon::parse($value);
        } catch (Throwable) {
            $carbon = Carbon::createFromTimestamp($value);
        }

        return [
            'label'        => $label,
            'message'      => $carbon->toDateString(),
            'messageColor' => 'green.600',
        ];
    }

    protected function renderDateTime(string $label, mixed $value): array
    {
        try {
            $carbon = Carbon::parse($value);
        } catch (Throwable) {
            $carbon = Carbon::createFromTimestamp($value);
        }

        return [
            'label'        => $label,
            'message'      => $carbon->toDateTimeString(),
            'messageColor' => 'green.600',
        ];
    }

    protected function renderDateDiff(string $label, mixed $value): array
    {
        try {
            $carbon = Carbon::parse($value);
        } catch (Throwable) {
            $carbon = Carbon::createFromTimestamp($value);
        }

        return [
            'label'        => $label,
            'message'      => $carbon->diffForHumans(),
            'messageColor' => DetermineColorByAge::execute($carbon->diffInDays()),
        ];
    }

    protected function renderDownloadsPerWindows(int $count): array
    {
        return [
            'label'        => 'downloads',
            'message'      => FormatNumber::execute($count).'/windows',
            'messageColor' => 'green.600',
        ];
    }

    protected function renderDownloadsPerMac(int $count): array
    {
        return [
            'label'        => 'downloads',
            'message'      => FormatNumber::execute($count).'/mac',
            'messageColor' => 'green.600',
        ];
    }

    protected function renderDownloadsPerLinux(int $count): array
    {
        return [
            'label'        => 'downloads',
            'message'      => FormatNumber::execute($count).'/linux',
            'messageColor' => 'green.600',
        ];
    }

    protected function renderDownloadsPerDay(int $count): array
    {
        return [
            'label'        => 'downloads',
            'message'      => FormatNumber::execute($count).'/day',
            'messageColor' => 'green.600',
        ];
    }

    protected function renderDownloadsPerMonth(int $count): array
    {
        return [
            'label'        => 'downloads',
            'message'      => FormatNumber::execute($count).'/month',
            'messageColor' => 'green.600',
        ];
    }

    protected function renderDownloadsPerQuarter(int $count): array
    {
        return [
            'label'        => 'downloads',
            'message'      => FormatNumber::execute($count).'/quarter',
            'messageColor' => 'green.600',
        ];
    }

    protected function renderDownloadsPerWeek(int $count): array
    {
        return [
            'label'        => 'downloads',
            'message'      => FormatNumber::execute($count).'/week',
            'messageColor' => 'green.600',
        ];
    }

    protected function renderDownloadsPerYear(int $count): array
    {
        return [
            'label'        => 'downloads',
            'message'      => FormatNumber::execute($count).'/year',
            'messageColor' => 'green.600',
        ];
    }

    protected function renderDownloads(mixed $count): array
    {
        return [
            'label'        => 'downloads',
            'message'      => FormatNumber::execute((float) $count),
            'messageColor' => 'green.600',
        ];
    }

    protected function renderGrade(string $label, mixed $value, ?string $grade = null): array
    {
        return [
            'label'        => $label,
            'message'      => is_numeric($value) ? FormatPercentage::execute($value) : $value,
            'messageColor' => DetermineColorByGrade::execute($grade ?? $value),
        ];
    }

    protected function renderLicense(mixed $license): array
    {
        return [
            'label'        => 'license',
            'message'      => DetermineLicense::execute($license),
            'messageColor' => 'blue.600',
        ];
    }

    protected function renderLines(int $count): array
    {
        return [
            'label'        => 'lines of code',
            'message'      => FormatNumber::execute($count),
            'messageColor' => 'blue.600',
        ];
    }

    protected function renderMoney(string $label, mixed $value, string $currency): array
    {
        return [
            'label'        => $label,
            'message'      => FormatMoney::execute((float) $value, $currency),
            'messageColor' => 'green.600',
        ];
    }

    protected function renderNumber(string $label, mixed $value): array
    {
        return [
            'label'        => $label,
            'message'      => FormatNumber::execute((float) $value),
            'messageColor' => 'green.600',
        ];
    }

    protected function renderPercentage(string $label, mixed $percentage): array
    {
        return [
            'label'        => $label,
            'message'      => FormatPercentage::execute($percentage ?? 0),
            'messageColor' => DetermineColorByPercentage::execute($percentage),
        ];
    }

    protected function renderSize(int $count): array
    {
        return [
            'label'        => 'size',
            'message'      => FormatBytes::execute($count),
            'messageColor' => 'blue.600',
        ];
    }

    protected function renderStatus(string $service, string $status): array
    {
        return [
            'label'        => strtolower($service),
            'message'      => $status,
            'messageColor' => DetermineColorByStatus::execute($status),
        ];
    }

    protected function renderText(string $label, mixed $message, string $messageColor): array
    {
        return [
            'label'        => $label,
            'message'      => $message,
            'messageColor' => $messageColor,
        ];
    }

    protected function renderVersion(string $version, ?string $label = null): array
    {
        return [
            'label'        => $label ?? $this->service(),
            'message'      => ExtractVersion::execute($version),
            'messageColor' => DetermineColorByVersion::execute($version),
        ];
    }
}
