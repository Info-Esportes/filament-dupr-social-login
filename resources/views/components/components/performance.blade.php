@props([
    'title' => 'Performance',
    'stats' => ['win' => 0, 'loss' => 0, 'total' => 0, 'win_rate' => 0],
])

<div class="flex flex-col items-center justify-between rounded-lg p-4 md:flex-row">
  <div class="min-w-0 flex-1">
    <span class="text-xs uppercase tracking-wider text-gray-400">
      {{ $title }}
    </span>
  </div>

  <div class="mt-2 flex flex-1 justify-between gap-6 md:mt-0 md:justify-end">
    <div class="text-center" title="{{ __('Wins') }}">
      <span class="text-primary-600 text-base font-semibold">{{ $stats['win'] }}</span>
      <div class="text-xs text-gray-400">{{ __('W') }}</div>
    </div>

    <div class="mx-1 h-6 w-px bg-gray-200"></div>

    <div class="text-center" title="{{ __('Losses') }}">
      <span class="text-primary-600 text-base font-semibold">{{ $stats['loss'] }}</span>
      <div class="text-xs text-gray-400">{{ __('L') }}</div>
    </div>

    <div class="mx-1 h-6 w-px bg-gray-200"></div>

    <div class="text-center" title="{{ __('Total') }}">
      <span class="text-primary-600 text-base font-semibold">{{ $stats['total'] }}</span>
      <div class="text-xs text-gray-400">{{ __('T') }}</div>
    </div>

    <div class="mx-1 h-6 w-px bg-gray-200"></div>

    <div class="text-center" title="{{ __('Win Rate') }}">
      <span class="text-primary-600 text-base font-semibold">{{ number_format($stats['win_rate'], 1) }}%</span>
      <div class="text-xs text-gray-400">{{ __('WR') }}</div>
    </div>
  </div>
</div>
