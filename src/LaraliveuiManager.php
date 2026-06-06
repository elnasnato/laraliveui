<?php

namespace Laraliveui;

use Laraliveui\Concerns\InteractsWithComponents;
use Illuminate\Support\Str;
use Laraliveui\ClassBuilder;

use function Livewire\on;

class LaraliveuiManager
{
    use InteractsWithComponents;

    public $hasRenderedAssets = false;

    protected $nonce = null;

    public function boot()
    {
        on('flush-state', function () {
            $this->hasRenderedAssets = false;
            $this->nonce = null;
        });

        $this->bootComponents();
    }

    public function markAssetsRendered()
    {
        $this->hasRenderedAssets = true;
    }

    public function nonce()
    {
        return $this->nonce ?? \Illuminate\Support\Facades\Vite::cspNonce();
    }

    public function scripts($options = [])
    {
        $this->markAssetsRendered();

        if (isset($options['nonce'])) {
            $this->nonce = $options['nonce'];
        }

        return AssetManager::scripts($options);
    }

    public function laraliveuiAppearance($options = [])
    {
        $this->markAssetsRendered();

        if (isset($options['nonce'])) {
            $this->nonce = $options['nonce'];
        }

        return AssetManager::laraliveuiAppearance($options);
    }

    public function classes($styles = null)
    {
        $builder = new ClassBuilder;

        return $styles ? $builder->add($styles) : $builder;
    }

    public function disallowWireModel($attributes, $componentName)
    {
        if ($attributes->whereStartsWith('wire:')->isNotEmpty()) {
            throw new \Exception('Cannot use wire:model on <'.$componentName.'>');
        }
    }

    public function splitAttributes($attributes, $by = ['class', 'style'], $strict = false)
    {
        return [
            $strict ? $attributes->only($by) : $attributes->whereStartsWith($by),
            $strict ? $attributes->except($by) : $attributes->whereDoesntStartWith($by),
        ];
    }

    public function forwardedAttributes($attributes, $propKeys)
    {
        $props = [];

        $unescape = fn ($value) => is_string($value) ? htmlspecialchars_decode($value, ENT_QUOTES) : $value;

        foreach ($propKeys as $key) {
            if (isset($attributes[$key])) {
                $props[$key] = $unescape($attributes[$key]);
            } elseif (isset($attributes[Str::kebab($key)])) {
                $props[$key] = $unescape($attributes[Str::kebab($key)]);
            }
        }

        return $props;
    }

    public function attributesAfter($prefix, $attributes, $default = [])
    {
        $newAttributes = new \Illuminate\View\ComponentAttributeBag($default);
        $keysToRemove = [];

        foreach ($attributes->getAttributes() as $key => $value) {
            if (str_starts_with($key, $prefix)) {
                $newAttributes[substr($key, strlen($prefix))] = $value;
                $keysToRemove[] = $key;
            }
        }

        foreach ($keysToRemove as $key) {
            unset($attributes[$key]);
        }

        return $newAttributes;
    }

    public function applyInset($inset, $top, $right, $bottom, $left)
    {
        if ($inset === null) return '';

        $insets = $inset === true
            ? collect(['top', 'right', 'bottom', 'left'])
            : str($inset)->explode(' ')->map(fn ($i) => trim($i));

        $insetClasses = [
            'top' => $top,
            'right' => $right,
            'bottom' => $bottom,
            'left' => $left,
        ];

        return $insets->map(fn ($i) => $insetClasses[$i])->join(' ');
    }

    public function componentExists($name)
    {
        if (app()->version() >= 12) {
            return app('view')->exists(hash('xxh128', 'laraliveui') . '::' . $name);
        }

        return app('view')->exists(md5('laraliveui') . '::' . $name);
    }
}
