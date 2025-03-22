<?php

namespace Rahona\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Fortify\Actions\DisableTwoFactorAuthentication;
use Livewire\Component;
use Rahona\Helpers\Toast;
use Rahona\Models\User;
use Symfony\Component\HttpFoundation\StreamedResponse;

class TwoFactorAuthForm extends Component
{
    public $showingQrCode = false;

    public $showingRecoveryCodes = false;

    public $confirmationCode = '';

    public function enableTwoFactorAuth()
    {
        $this->redirect(route('user.enableTwoFactor'));

        $this->showingQrCode = true;
    }

    public function disableTwoFactorAuth(DisableTwoFactorAuthentication $disable)
    {
        /** @var User $user */
        $user = Auth::user();
        $disable($user);

        $user->forceFill([
            'two_factor_recovery_codes_downloaded' => false,
        ]);

        $this->showingQrCode = false;

        Toast::success($this, __('2fa.disabled_message'));
    }

    public function confirmTwoFactorAuth()
    {
        $this->validate([
            'confirmationCode' => 'required|string',
        ]);

        /** @var User $user */
        $user = Auth::user();

        if ($user->confirmTwoFactorAuthentication($this->confirmationCode)) {
            $this->showingQrCode = true;
            $this->showingRecoveryCodes = true;
            Toast::success($this, __('2fa.enabled_message'));
        } else {
            Toast::danger($this, __('2fa.wrong_code_on_setup'));
            $this->addError('confirmationCode', __('2fa.wrong_code_on_setup'));
        }
    }

    public function downloadRecoveryCodes(): ?StreamedResponse
    {
        /** @var User $user */
        $user = Auth::user();

        if ($user->two_factor_recovery_codes_downloaded) {
            return null;
        }

        $codes = json_decode(decrypt($user->two_factor_recovery_codes), true);
        $content = implode("\n", $codes);

        // Marquer les codes comme téléchargés
        $user->forceFill([
            'two_factor_recovery_codes_downloaded' => true,
        ])->save();

        Toast::success($this, __('2fa.backup_code_downloaded'));

        $projectName = Str::slug(config('app.name'));
        $fileName = "{$projectName}-2fa-recovery-codes.txt";

        return response()->streamDownload(function () use ($content) {
            echo $content;
        }, $fileName);
    }

    public function render()
    {
        return view('livewire.two-factor-auth-form');
    }
}
