<?php

namespace Rahona\Livewire;

use Illuminate\Support\Facades\App;
use Livewire\Component;

class LanguageSelectorModal extends Component
{
    public $show = false;

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

    protected $listeners = ['open-language-modal' => 'openModal'];

    public function openModal()
    {
        $this->show = true;
    }

    public function switchLanguage($locale)
    {
        if (auth()->check()) {
            auth()->user()->update(['locale' => $locale]);
        }

        session(['locale' => $locale]);
        app()->setLocale($locale);

        return redirect(request()->header('Referer'));
    }

    public function render()
    {
        return view('livewire.language-selector-modal', [
            'currentLocale' => App::getLocale(),
        ]);
    }
}
