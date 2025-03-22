<?php

namespace Rahona\Livewire;

use Illuminate\Support\Facades\App;
use Livewire\Component;

class LanguageSelectorButton extends Component
{
    public $languages = [
        'fr' => [
            'name' => 'French',
            'flag' => 'fr',
            'native' => 'Français',
        ],
        'en' => [
            'name' => 'English',
            'flag' => 'gb',
            'native' => 'English',
        ],
        'hu' => [
            'name' => 'Hungarian',
            'flag' => 'hu',
            'native' => 'Magyar',
        ],
    ];

    public function openModal()
    {
        $this->dispatch('open-language-modal');
    }

    public function render()
    {
        return view('livewire.language-selector-button', [
            'currentLocale' => App::getLocale(),
        ]);
    }
}
