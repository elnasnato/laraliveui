@props([
    'currentStep' => 0,
    'finishLabel' => 'Finish',
    'nextLabel' => 'Next',
    'previousLabel' => 'Previous',
    'showSteps' => true,
])

@php
$stepNames = [];
@endphp

<div
    x-data="{
        currentStep: @js($currentStep),
        steps: [],
        init() {
            this.$nextTick(() => {
                this.steps = this.$el.querySelectorAll('[data-wizard-step]')
            })
        },
        get isFirstStep() { return this.currentStep === 0 },
        get isLastStep() { return this.currentStep >= this.steps.length - 1 },
        get totalSteps() { return this.steps.length },
        get progressPercentage() {
            if (this.totalSteps === 0) return 0
            return ((this.currentStep + 1) / this.totalSteps) * 100
        },
        isStepActive(el) {
            return Array.from(this.steps).indexOf(el) === this.currentStep
        },
        next() {
            if (this.isLastStep) return
            this.currentStep++
        },
        previous() {
            if (this.isFirstStep) return
            this.currentStep--
        },
        goToStep(index) {
            if (index >= 0 && index < this.totalSteps && index <= this.currentStep + 1) {
                this.currentStep = index
            }
        }
    }"
    x-on:keydown.meta.enter.prevent="if (isLastStep) $dispatch('wizard-finish')"
    x-on:keydown.ctrl.enter.prevent="if (isLastStep) $dispatch('wizard-finish')"
    {{ $attributes }}
>
    {{-- Step indicators --}}
    @if ($showSteps)
        <nav x-show="steps.length > 0" class="mb-8">
            <div class="flex items-center gap-2">
                <template x-for="(step, index) in steps" :key="index">
                    <div class="flex items-center gap-2">
                        <button
                            type="button"
                            x-on:click="goToStep(index)"
                            x-bind:class="{
                                'bg-zinc-800 text-white dark:bg-white dark:text-zinc-800': index === currentStep,
                                'bg-zinc-200 text-zinc-500 dark:bg-zinc-700 dark:text-zinc-400 cursor-pointer hover:bg-zinc-300 dark:hover:bg-zinc-600': index < currentStep,
                                'bg-zinc-100 text-zinc-400 dark:bg-zinc-800 dark:text-zinc-500': index > currentStep,
                            }"
                            class="flex size-8 shrink-0 items-center justify-center rounded-full text-xs font-semibold transition"
                            x-text="index + 1"
                        ></button>

                        <span
                            x-show="step.getAttribute('data-step-name')"
                            class="text-sm font-medium"
                            x-bind:class="{
                                'text-zinc-800 dark:text-white': index === currentStep,
                                'text-zinc-400 dark:text-zinc-500': index !== currentStep,
                            }"
                            x-text="step.getAttribute('data-step-name')"
                        ></span>

                        <template x-if="index < steps.length - 1">
                            <div class="h-px flex-1 bg-zinc-200 dark:bg-zinc-700"></div>
                        </template>
                    </div>
                </template>
            </div>
        </nav>
    @endif

    {{-- Steps content --}}
    {{ $slot }}

    {{-- Progress bar --}}
    <div x-show="steps.length > 1" class="mt-6 h-1 w-full rounded-full bg-zinc-200 dark:bg-zinc-700 overflow-hidden">
        <div class="h-full rounded-full bg-zinc-800 dark:bg-white transition-all duration-300" x-bind:style="`width: ${progressPercentage}%`"></div>
    </div>

    {{-- Navigation buttons --}}
    <div class="mt-6 flex items-center justify-between">
        <div>
            <button
                type="button"
                x-on:click="previous()"
                x-show="!isFirstStep"
                class="inline-flex items-center gap-2 rounded-lg border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-800 px-4 py-2 text-sm font-medium text-zinc-700 dark:text-zinc-300 hover:bg-zinc-50 dark:hover:bg-zinc-700 transition shadow-xs"
            >
                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.78 4.22a.75.75 0 0 1 0 1.06L7.06 8l2.72 2.72a.75.75 0 1 1-1.06 1.06L5.47 8.53a.75.75 0 0 1 0-1.06l3.25-3.25a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" />
                </svg>
                {{ $previousLabel }}
            </button>
        </div>

        <div class="flex items-center gap-3">
            <button
                type="button"
                x-on:click="next()"
                x-show="!isLastStep"
                class="inline-flex items-center gap-2 rounded-lg bg-zinc-800 dark:bg-white px-4 py-2 text-sm font-medium text-white dark:text-zinc-800 hover:bg-zinc-700 dark:hover:bg-zinc-200 transition shadow-xs"
            >
                {{ $nextLabel }}
                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor">
                    <path fill-rule="evenodd" d="M6.22 4.22a.75.75 0 0 1 1.06 0l3.25 3.25a.75.75 0 0 1 0 1.06l-3.25 3.25a.75.75 0 0 1-1.06-1.06L8.94 8 6.22 5.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                </svg>
            </button>

            <button
                type="button"
                x-on:click="$dispatch('wizard-finish')"
                x-show="isLastStep"
                class="inline-flex items-center gap-2 rounded-lg bg-zinc-800 dark:bg-white px-4 py-2 text-sm font-medium text-white dark:text-zinc-800 hover:bg-zinc-700 dark:hover:bg-zinc-200 transition shadow-xs"
            >
                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor">
                    <path fill-rule="evenodd" d="M12.416 3.376a.75.75 0 0 1 .208 1.04l-5 7.5a.75.75 0 0 1-1.154.114l-3-3a.75.75 0 0 1 1.06-1.06l2.353 2.353 4.493-6.74a.75.75 0 0 1 1.04-.207Z" clip-rule="evenodd" />
                </svg>
                {{ $finishLabel }}
            </button>
        </div>
    </div>
</div>
