<?php

namespace Tests\Feature;

use App\Livewire\Auth;
use App\Models\User;
use App\Models\Verification;
use App\Services\V1\Auth\AuthFactory;
use App\Services\V1\Otp\OtpFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Config;
use Livewire\Livewire;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    /**
     * @return void
     */
    public function test_otp_sms(): void
    {
        Config::set('general.auth', AuthFactory::TYPE_OTP);
        Config::set('general.otp', OtpFactory::TYPE_SMS);

        Livewire::test(Auth::class)
            ->set('mobile', '989121895831')
            ->call('initialAuth')
            ->assertHasNoErrors()
            ->assertStatus(200);

        Livewire::test(Auth::class)
            ->set('mobileBackup', '989121895831')
            ->call('resendVerification')
            ->assertHasNoErrors()
            ->assertStatus(200);

        $verification = Verification::orderBy('expire_at', 'desc')->first();

        Livewire::test(Auth::class)
            ->set('mobileBackup', '989121895831')
            ->set('code', $verification->code)
            ->call('verify')
            ->assertHasNoErrors()
            ->assertStatus(200);
    }
}
