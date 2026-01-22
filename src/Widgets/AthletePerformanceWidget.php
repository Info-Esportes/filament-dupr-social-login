<?php

namespace InfoEsportes\FilamentDuprSocialLogin\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Support\Arr;
use Livewire\Attributes\Locked;

class AthletePerformanceWidget extends Widget
{
    protected string $view = 'filament-dupr-social-login::widgets.athlete-performance-widget';

    #[Locked]
    protected static $duprId = null;

    protected static function getDuprId(): ?string
    {
        $user = auth(filament()->getCurrentPanel()?->getAuthGuard())->user();
        if (! static::$duprId && $user instanceof \InfoEsportes\FilamentDuprSocialLogin\Contracts\HasDUPR && ($duprId = $user->getDuprId())) {
            static::$duprId = $duprId;
        }

        return static::$duprId;
    }

    protected function calculateWinRate(int $wins, int $total): float
    {
        if ($total === 0) {
            return 0.0;
        }

        return ($wins / $total) * 100;
    }

    public static function canView(): bool
    {
        return filled(static::getDuprId());
    }

    /**
     * @return array<string, mixed>
     */
    protected function getViewData(): array
    {
        $duprId = static::getDuprId();

        $data = session()->only(["dupr_{$duprId}_data"]);

        $singles = Arr::get($data, 'performance.singles', ['win' => 0, 'loss' => 0, 'total' => 0]);
        $doubles = Arr::get($data, 'performance.doubles', ['win' => 0, 'loss' => 0, 'total' => 0]);

        $singles['win_rate'] = $this->calculateWinRate($singles['win'], $singles['total']);
        $doubles['win_rate'] = $this->calculateWinRate($doubles['win'], $doubles['total']);

        return [
            'singles' => $singles,
            'doubles' => $doubles,
        ];
    }
}
