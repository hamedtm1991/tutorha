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

    /**
     * @return void
     */
    public function initialAuth(): void
    {
        $request = $this->validate([
            'mobile' => 'required|numeric|digits_between:11,12',
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
        $request = $this->validate([
            'code' => 'required|numeric|digits_between:6,6',
        ]);

        $authService = new AuthService();
        $authService->mobile = $this->mobileBackup;
        $authService->code = $request['code'];
        $response = $authService->serviceController();

        if (!$response->getData()->status) {
            $this->addError('code', $response->getData()->message);
        }

        if (\Illuminate\Support\Facades\Auth::user()->hasAnyRole(Role::all())) {
            $this->redirect('/admin/dashboard');
        } else {
            $this->redirect('/home');
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
