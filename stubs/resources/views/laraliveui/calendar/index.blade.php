@props([
    'month' => null,
    'year' => null,
    'selected' => null,
])

@php
$now = now();
$month = $month ?? $now->month;
$year = $year ?? $now->year;
$firstDay = now()->setYear($year)->setMonth($month)->startOfMonth();
$daysInMonth = $firstDay->daysInMonth;
$startingDay = $firstDay->dayOfWeek;
@endphp

<div {{ $attributes->class('w-full') }}>
    <div class="mb-2 flex items-center justify-between">
        <span class="text-sm font-medium text-zinc-800 dark:text-white">
            {{ $firstDay->format('F Y') }}
        </span>
    </div>

    <div class="grid grid-cols-7 gap-px text-center text-xs">
        @foreach (['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] as $day)
            <div class="py-1 text-zinc-500 dark:text-zinc-400">{{ $day }}</div>
        @endforeach

        @for ($i = 0; $i < $startingDay; $i++)
            <div></div>
        @endfor

        @for ($day = 1; $day <= $daysInMonth; $day++)
            @php $isSelected = $selected && now()->setYear($year)->setMonth($month)->setDay($day)->isSameDay($selected); @endphp
            <div class="py-1 {{ $isSelected ? 'rounded-full bg-zinc-800 text-white dark:bg-white dark:text-zinc-800' : 'text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800' }}">
                {{ $day }}
            </div>
        @endfor
    </div>
</div>
