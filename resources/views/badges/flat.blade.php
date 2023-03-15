<svg width="{{ ($scale * $width) / 10 }}" height="{{ $scale * 20 }}" viewBox="0 0 {{ $width }} 200"
    xmlns="http://www.w3.org/2000/svg"{{ $xlink }} role="img" aria-label="{{ $accessibleText }}">
    <title>{{ $accessibleText }}</title>
    <g>
        <rect fill="#{{ $labelColor }}" width="{{ $sbRectWidth }}" height="200" />
        <rect fill="#{{ $statusColor }}" x="{{ $sbRectWidth }}" width="{{ $stRectWidth }}" height="200" />
    </g>
    <g aria-hidden="true" fill="#fff" text-anchor="start" font-family="Verdana,DejaVu Sans,sans-serif"
        font-size="110">
        <text x="{{ $sbTextStart + 10 }}" y="148" textLength="{{ $sbTextWidth }}" fill="#000"
            opacity="0.1">{{ $label }}</text>
        <text x="{{ $sbTextStart }}" y="138" textLength="{{ $sbTextWidth }}">{{ $label }}</text>
        <text x="{{ $sbRectWidth + 55 }}" y="148" textLength="{{ $stTextWidth }}" fill="#000"
            opacity="0.1">{{ $status }}</text>
        <text x="{{ $sbRectWidth + 45 }}" y="138" textLength="{{ $stTextWidth }}">{{ $status }}</text>
    </g>
    @if ($icon)
        <image x="40" y="35" width="{{ $iconWidth }}" height="132"
            xlink:href="{{ $icon }}" />
    @endif
</svg>
