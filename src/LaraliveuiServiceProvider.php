<?php

namespace Laraliveui;

use Illuminate\View\ComponentAttributeBag;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Arr;

class LaraliveuiServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->alias(LaraliveuiManager::class, 'laraliveui');

        $this->app->singleton(LaraliveuiManager::class);

        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Laraliveui', \Laraliveui\Laraliveui::class);
    }

    public function boot(): void
    {
        $this->bootComponentPath();
        $this->bootFallbackBlazeDirectives();
        $this->bootTagCompiler();
        $this->bootMacros();

        app('livewire')->propertySynthesizer(DateRangeSynth::class);

        AssetManager::boot();

        app('laraliveui')->boot();

        $this->bootCommands();
    }

    public function bootFallbackBlazeDirectives()
    {
        Blade::directive('blaze', fn () => '');

        Blade::directive('unblaze', function ($expression) {
            return ''
                . '<'.'?php $__getScope = fn($scope = []) => $scope; ?>'
                . '<'.'?php if (isset($scope)) $__scope = $scope; ?>'
                . '<'.'?php $scope = $__getScope('.$expression.'); ?>';
        });

        Blade::directive('endunblaze', function () {
            return '<'.'?php if (isset($__scope)) { $scope = $__scope; unset($__scope); } ?>';
        });
    }

    public function bootComponentPath()
    {
        if (file_exists(resource_path('views/laraliveui'))) {
            Blade::anonymousComponentPath(resource_path('views/laraliveui'), 'laraliveui');
        }

        Blade::anonymousComponentPath(__DIR__.'/../stubs/resources/views/laraliveui', 'laraliveui');
    }

    public function bootTagCompiler()
    {
        $compiler = new LaraliveuiTagCompiler(
            app('blade.compiler')->getClassComponentAliases(),
            app('blade.compiler')->getClassComponentNamespaces(),
            app('blade.compiler')
        );

        app()->bind('laraliveui.compiler', fn () => $compiler);

        app('blade.compiler')->precompiler(function ($in) use ($compiler) {
            return $compiler->compile($in);
        });
    }

    public function bootMacros()
    {
        app('view')::macro('getCurrentComponentData', function () {
            return $this->currentComponentData;
        });

        ComponentAttributeBag::macro('pluck', function ($key, $default = null) {
            $result = $this->get($key);

            unset($this->attributes[$key]);

            return $result ?? $default;
        });
    }

    public function bootCommands()
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->commands([
            Console\IconCommand::class,
        ]);
    }
}
