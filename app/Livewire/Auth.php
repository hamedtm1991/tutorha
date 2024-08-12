<?php

namespace App\Livewire;

use App\Models\Role;
use App\Services\V1\Auth\AuthService;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Auth extends Component
{
    public string $mobile = '';
    public string $mobileBackup = '';
    public string $code = '';
    public bool $showCode = false;
    public bool $clearInputs = false;

    /**
     * @return void
     */
    public function initialAuth(): void
    {
        $this->mobile = convertPersianNumbersToEnglish($this->mobile);
        $request = $this->validate([
            'mobile' => 'required|numeric|min_digits:11|max_digits:12',
        ]);

        if (substr($request['mobile'], 0, 2) != 98) {
            $request['mobile'] = '98' . ltrim($request['mobile'], '0');
        }

        $this->mobileBackup = $request['mobile'];

        $authService = new AuthService();
        $authService->mobile = $request['mobile'];
        $response = $authService->serviceController();

        if ($response->getData()->status) {
            $this->showCode = true;
            $this->mobile = '';
            $this->dispatch('verificationTimer');
        }
    }

    /**
     * @return void
     */
    public function resendVerification(): void
    {
        $this->clearInputs = true;
        $authService = new AuthService();
        $authService->mobile = $this->mobileBackup;
        $response = $authService->serviceController();

        if ($response->getData()->status) {
            $this->showCode = true;
            $this->mobile = '';
            $this->dispatch('verificationTimer');
        }
    }

    /**
     * @return void
     */
    public function verify(): void
    {
        $this->clearInputs = true;
        $this->code = convertPersianNumbersToEnglish($this->code);
        $request = $this->validate([
            'code' => 'required|numeric|min_digits:4|max_digits:4',
        ]);

        $authService = new AuthService();
        $authService->mobile = $this->mobileBackup;
        $authService->code = $request['code'];
        $response = $authService->serviceController();

        dd($response);

        if (!$response->getData()->status) {
            $this->addError('code', $response->getData()->message);
        }

        if (\Illuminate\Support\Facades\Auth::check()) {
            if (\Illuminate\Support\Facades\Auth::user()->hasAnyRole(Role::all())) {
                $this->redirect('/admin/dashboard');
            } else {
                $this->redirect('/');
            }
        }
    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view('livewire.auth');
    }
}
