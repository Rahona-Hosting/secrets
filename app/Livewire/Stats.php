<?php

namespace Rahona\Livewire;

use Livewire\Component;

class Stats extends Component
{
    protected $listeners = ['secret-created' => '$refresh'];

    public function render()
    {
        $user = auth()->user();

        $stats = [
            'active' => $user->secrets()
                ->where(function ($query) {
                    $query->whereNull('expires_at')
                        ->orWhere('expires_at', '>', now());
                })
                ->whereDoesntHave('access', function ($query) {
                    $query->where('secret_viewed', true);
                })
                ->where(function ($query) {
                    $query->whereNull('max_views')
                        ->orWhereRaw('(SELECT COUNT(*) FROM secret_accesses WHERE secret_id = secrets.id AND secret_viewed = true) < secrets.max_views');
                })
                ->count(),

            'shared' => $user->secrets()
                ->where(function ($query) {
                    $query->whereHas('access', function ($query) {
                        $query->where('secret_viewed', true);
                    });
                })
                ->orWhere(function ($query) {
                    $query->whereNotNull('max_views')
                        ->whereRaw('(SELECT COUNT(*) FROM secret_accesses WHERE secret_id = secrets.id AND secret_viewed = true) >= secrets.max_views');
                })
                ->count(),

            'expired' => $user->secrets()
                ->where(function ($query) {
                    $query->where('expires_at', '<=', now())
                        ->whereDoesntHave('access', function ($query) {
                            $query->where('secret_viewed', true);
                        });
                })
                ->count(),
        ];

        return view('livewire.stats', [
            'stats' => $stats,
        ]);
    }
}
