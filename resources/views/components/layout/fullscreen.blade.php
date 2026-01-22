@php
  use Filament\Support\Enums\Width;

  $livewire ??= null;

  $renderHookScopes = $livewire?->getRenderHookScopes();
  $maxContentWidth ??= filament()->getSimplePageMaxContentWidth() ?? Width::Large;

  if (is_string($maxContentWidth)) {
      $maxContentWidth = Width::tryFrom($maxContentWidth) ?? $maxContentWidth;
  }
@endphp

<x-filament-panels::layout.base>
  {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::SIMPLE_LAYOUT_START, scopes: $renderHookScopes) }}

  @if (($hasTopbar ?? true) && filament()->auth()->check())
    <div class="fi-simple-layout-header">
      @if (filament()->hasDatabaseNotifications())
        @livewire(Filament\Livewire\DatabaseNotifications::class, [
            'lazy' => filament()->hasLazyLoadedDatabaseNotifications(),
            'position' => \Filament\Enums\DatabaseNotificationsPosition::Topbar,
        ])
      @endif

      @if (filament()->hasUserMenu())
        @livewire(Filament\Livewire\SimpleUserMenu::class)
      @endif
    </div>
  @endif

  <main class="h-screen w-screen">
    {{ $slot }}
  </main>

  {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::FOOTER, scopes: $renderHookScopes) }}

  {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::SIMPLE_LAYOUT_END, scopes: $renderHookScopes) }}
</x-filament-panels::layout.base>
