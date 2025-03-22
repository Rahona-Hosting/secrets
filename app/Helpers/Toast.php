<?php

namespace Rahona\Helpers;

use Livewire\Component;

class Toast
{
    /**
     * Display a green success Toast
     */
    public static function success(Component $component, string $message): void
    {
        self::wrap($component, $message, 'success');
    }

    /**
     * Display a red danger Toast
     */
    public static function danger(Component $component, string $message): void
    {
        self::wrap($component, $message, 'danger');
    }

    /**
     * Display an orange warning Toast
     */
    public static function warning(Component $component, string $message): void
    {
        self::wrap($component, $message, 'warning');
    }

    /**
     * Display a blue info Toast
     */
    public static function info(Component $component, string $message): void
    {
        self::wrap($component, $message, 'info');
    }

    /**
     * Wrap the Toast to simplify signature
     */
    private static function wrap(Component $component, string $message, string $level): void
    {
        $component->dispatch('toast', [
            'message' => $message,
            'level' => $level,
        ]);
    }
}
