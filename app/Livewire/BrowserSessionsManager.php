<?php

namespace Rahona\Livewire;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class BrowserSessionsManager extends Component
{
    public $sessions = [];

    public function mount()
    {
        $this->sessions = $this->getSessions();
    }

    public function getSessions()
    {
        if (config('session.driver') !== 'database') {
            return [];
        }

        return collect(
            DB::table('sessions')
                ->where('user_id', auth()->user()->getAuthIdentifier())
                ->orderBy('last_activity', 'desc')
                ->get()
        )->map(function ($session) {
            return (object) [
                'agent' => $session->user_agent,
                'ip' => $session->ip_address,
                'isCurrentDevice' => $session->id === session()->getId(),
                'lastActive' => Carbon::createFromTimestamp($session->last_activity)->diffForHumans(),
            ];
        })->all();
    }

    public function render()
    {
        return view('livewire.browser-sessions-manager');
    }
}
