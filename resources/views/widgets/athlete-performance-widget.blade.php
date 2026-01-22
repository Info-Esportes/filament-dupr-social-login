<x-filament-widgets::widget>
  <x-filament::section>
    <div class="flex select-none flex-col gap-4">
      <x-filament-dupr-social-login::components.performance :stats="$singles" title="{{ __('Singles') }}" />

      <x-filament-dupr-social-login::components.performance :stats="$doubles" title="{{ __('Doubles') }}" />
    </div>
  </x-filament::section>
</x-filament-widgets::widget>
