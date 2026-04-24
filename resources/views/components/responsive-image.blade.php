@props([
    'src',
    'alt' => '',
    'class' => '',
    'sizes' => '100vw',
    'widths' => [480, 768, 1200, 1600],
    'loading' => 'lazy',
    'decoding' => 'async',
    'fetchpriority' => null,
    'style' => null,
])

@php
    $rawSrc = trim((string) $src);
    $resolvedSrc = $rawSrc;
    $srcset = null;
    $intrinsicWidth = null;
    $intrinsicHeight = null;

    if ($rawSrc !== '') {
        $isAbsolute = preg_match('#^https?://#', $rawSrc) === 1;

        if (! $isAbsolute) {
            $path = ltrim(parse_url($rawSrc, PHP_URL_PATH) ?: $rawSrc, '/');
            $webpPath = preg_replace('/\.(jpe?g|png)$/i', '.webp', $path);

            if (is_string($webpPath) && file_exists(public_path($webpPath))) {
                $path = $webpPath;
            }

            $resolvedSrc = asset($path);
            $sourcePath = public_path($path);
            $dir = pathinfo($path, PATHINFO_DIRNAME);
            $name = pathinfo($path, PATHINFO_FILENAME);
            $variantDir = $dir === '.' ? '' : $dir . '/';
            $srcsetParts = [];

            foreach ($widths as $width) {
                $variantPath = $variantDir . $name . '-' . (int) $width . '.webp';

                if (file_exists(public_path($variantPath))) {
                    $srcsetParts[] = asset($variantPath) . ' ' . (int) $width . 'w';
                }
            }

            if (file_exists($sourcePath)) {
                $imageSize = @getimagesize($sourcePath);

                if (is_array($imageSize) && ! empty($imageSize[0])) {
                    $intrinsicWidth = (int) $imageSize[0];
                    $intrinsicHeight = ! empty($imageSize[1]) ? (int) $imageSize[1] : null;
                    $srcsetParts[] = asset($path) . ' ' . (int) $imageSize[0] . 'w';
                } elseif (str_ends_with(strtolower($sourcePath), '.svg')) {
                    $svg = @file_get_contents($sourcePath);

                    if (is_string($svg) && preg_match('/viewBox="[\d.\s-]+ ([\d.]+) ([\d.]+)"/i', $svg, $matches)) {
                        $intrinsicWidth = (int) round((float) $matches[1]);
                        $intrinsicHeight = (int) round((float) $matches[2]);
                    }
                }
            }

            if ($srcsetParts !== []) {
                $srcset = implode(', ', $srcsetParts);
            }
        } elseif (str_contains($rawSrc, 'images.unsplash.com')) {
            $parts = parse_url($rawSrc);
            $baseUrl = ($parts['scheme'] ?? 'https') . '://' . ($parts['host'] ?? 'images.unsplash.com') . ($parts['path'] ?? '');
            $srcsetParts = [];

            foreach ($widths as $width) {
                $query = http_build_query([
                    'auto' => 'format',
                    'fit' => 'crop',
                    'fm' => 'webp',
                    'q' => 80,
                    'w' => (int) $width,
                ]);

                $srcsetParts[] = $baseUrl . '?' . $query . ' ' . (int) $width . 'w';
            }

            $largestWidth = (int) max($widths);
            $resolvedSrc = $baseUrl . '?' . http_build_query([
                'auto' => 'format',
                'fit' => 'crop',
                'fm' => 'webp',
                'q' => 80,
                'w' => $largestWidth,
            ]);
            $srcset = implode(', ', $srcsetParts);
        }
    }
@endphp

<img
    src="{{ $resolvedSrc }}"
    @if($srcset) srcset="{{ $srcset }}" sizes="{{ $sizes }}" @endif
    alt="{{ $alt }}"
    @if($intrinsicWidth) width="{{ $intrinsicWidth }}" @endif
    @if($intrinsicHeight) height="{{ $intrinsicHeight }}" @endif
    class="{{ $class }}"
    loading="{{ $loading }}"
    decoding="{{ $decoding }}"
    @if($fetchpriority) fetchpriority="{{ $fetchpriority }}" @endif
    @if($style) style="{{ $style }}" @endif
    {{ $attributes->except(['src', 'alt', 'class', 'sizes', 'widths', 'loading', 'decoding', 'fetchpriority', 'style']) }}
>
