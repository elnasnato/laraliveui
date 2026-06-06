<?php

namespace Laraliveui;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Blade;
use Illuminate\Http\Request;

class AssetManager
{
    static function boot()
    {
        $instance = new static;

        $instance->registerAssetDirective();
        $instance->registerAssetRoutes();
    }

    public function registerAssetDirective()
    {
        Blade::directive('laraliveuiScripts', function ($expression) {
            return <<<PHP
            <?php app('livewire')->forceAssetInjection(); ?>
            {!! app('laraliveui')->scripts($expression) !!}
            PHP;
        });

        Blade::directive('laraliveuiAppearance', function ($expression) {
            return <<<PHP
            {!! app('laraliveui')->laraliveuiAppearance($expression) !!}
            PHP;
        });
    }

    public function registerAssetRoutes()
    {
        Route::get('/laraliveui/laraliveui.js', [static::class, 'laraliveuiJs']);
        Route::get('/laraliveui/laraliveui.min.js', [static::class, 'laraliveuiMinJs']);
    }

    public function laraliveuiJs() {
        return $this->pretendResponseIsFile(__DIR__.'/../dist/laraliveui.js', 'text/javascript');
    }

    public function laraliveuiMinJs() {
        return $this->pretendResponseIsFile(__DIR__.'/../dist/laraliveui.min.js', 'text/javascript');
    }

    public static function scripts($options = [])
    {
        $versionHash = md5_file(__DIR__.'/../dist/laraliveui.min.js');

        $nonce = isset($options) && isset($options['nonce']) ? ' nonce="' . $options['nonce'] . '"' : '';

        if (config('app.debug')) {
            return '<script src="'. url('/laraliveui/laraliveui.js?id='. $versionHash) . '" data-navigate-once' . $nonce . '></script>';
        } else {
            return '<script src="'. url('/laraliveui/laraliveui.min.js?id='. $versionHash) . '" data-navigate-once' . $nonce . '></script>';
        }
    }

    public static function laraliveuiAppearance($options = [])
    {
        $nonce = isset($options) && isset($options['nonce']) ? ' nonce="' . $options['nonce'] . '"' : '';

        return <<<HTML
<style$nonce>
    :root.dark {
        color-scheme: dark;
    }
</style>
<script$nonce>
    window.LaraLiveUI = {
        applyAppearance (appearance) {
            let applyDark = () => document.documentElement.classList.add('dark')
            let applyLight = () => document.documentElement.classList.remove('dark')

            if (appearance === 'system') {
                let media = window.matchMedia('(prefers-color-scheme: dark)')

                window.localStorage.removeItem('laraliveui.appearance')

                media.matches ? applyDark() : applyLight()
            } else if (appearance === 'dark') {
                window.localStorage.setItem('laraliveui.appearance', 'dark')

                applyDark()
            } else if (appearance === 'light') {
                window.localStorage.setItem('laraliveui.appearance', 'light')

                applyLight()
            }
        }
    }

    window.LaraLiveUI.applyAppearance(window.localStorage.getItem('laraliveui.appearance') || 'system')
</script>
HTML;
    }

    public function pretendResponseIsFile($file, $contentType = 'application/javascript; charset=utf-8')
    {
        $lastModified = filemtime($file);

        return $this->cachedFileResponse($file, $contentType, $lastModified,
            fn ($headers) => response()->file($file, $headers));
    }

    protected function cachedFileResponse($filename, $contentType, $lastModified, $downloadCallback)
    {
        $expires = strtotime('+1 year');
        $cacheControl = 'public, max-age=31536000';

        if ($this->matchesCache($lastModified)) {
            return response('', 304, [
                'Expires' => $this->httpDate($expires),
                'Cache-Control' => $cacheControl,
            ]);
        }

        $headers = [
            'Content-Type' => $contentType,
            'Expires' => $this->httpDate($expires),
            'Cache-Control' => $cacheControl,
            'Last-Modified' => $this->httpDate($lastModified),
        ];

        return $downloadCallback($headers);
    }

    protected function matchesCache($lastModified)
    {
        $ifModifiedSince = app(Request::class)->header('if-modified-since');

        return $ifModifiedSince !== null && @strtotime($ifModifiedSince) === $lastModified;
    }

    protected function httpDate($timestamp)
    {
        return sprintf('%s GMT', gmdate('D, d M Y H:i:s', $timestamp));
    }
}
