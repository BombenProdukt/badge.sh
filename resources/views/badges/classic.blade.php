<svg width="{{ ($scale * $width) / 10 }}" height="{{ $scale * 20 }}" viewBox="0 0 {{ $width }} 200"
    xmlns="http://www.w3.org/2000/svg"{{ $xlink }} role="img" aria-label="{{ $accessibleText }}">
    <title>{{ $accessibleText }}</title>
    <linearGradient id="a" x2="0" y2="100%">
        <stop offset="0" stop-opacity=".1" stop-color="#EEE" />
        <stop offset="1" stop-opacity=".1" />
    </linearGradient>
    <mask id="m">
        <rect width="{{ $width }}" height="200" rx="30" fill="#FFF" />
    </mask>
    <g mask="url(#m)">
        <rect width="{{ $sbRectWidth }}" height="200" fill="#{{ $labelColor }}" />
        <rect width="{{ $stRectWidth }}" height="200" fill="#{{ $statusColor }}" x="{{ $sbRectWidth }}" />
        <rect width="{{ $width }}" height="200" fill="url(#a)" />
    </g>
    <g aria-hidden="true" fill="#fff" text-anchor="start" font-family="Verdana,DejaVu Sans,sans-serif"
        font-size="110">
        <text x="{{ $sbTextStart + 10 }}" y="148" textLength="{{ $sbTextWidth }}" fill="#000"
            opacity="0.25">{{ $label }}</text>
        <text x="{{ $sbTextStart }}" y="138" textLength="{{ $sbTextWidth }}">{{ $label }}</text>
        <text x="{{ $sbRectWidth + 55 }}" y="148" textLength="{{ $stTextWidth }}" fill="#000"
            opacity="0.25">{{ $status }}</text>
        <text x="{{ $sbRectWidth + 45 }}" y="138" textLength="{{ $stTextWidth }}">{{ $status }}</text>
    </g>
    @if ($icon)
        <image x="40" y="35" width="{{ $iconWidth }}" height="130"
            xlink:href="{{ $icon }}" />
    @endif
</svg>
