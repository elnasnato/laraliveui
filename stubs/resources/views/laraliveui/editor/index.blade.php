@props([
    'name' => null,
    'value' => '',
    'placeholder' => 'Write something...',
])

<div
    x-data="{
        content: @js($value),
        init() {
            this.\$watch('content', val => {
                if (this.\$refs.hidden) this.\$refs.hidden.value = val
            })
        }
    }"
    {{ $attributes->class('w-full') }}
>
    <div
        x-ref="editable"
        contenteditable="true"
        x-html="content"
        x-on:input="content = $el.innerHTML"
        class="min-h-[200px] w-full rounded-lg border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-800 p-4 text-sm text-zinc-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-zinc-500"
        placeholder="{{ $placeholder }}"
    ></div>
    <input x-ref="hidden" type="hidden" @if ($name) name="{{ $name }}" @endif value="{{ $value }}" />
</div>
