<?php

namespace App\Services\V1\Auth;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use PragmaRX\Google2FA\Exceptions\IncompatibleWithGoogleAuthenticatorException;
use PragmaRX\Google2FA\Exceptions\InvalidCharactersException;
use PragmaRX\Google2FA\Exceptions\SecretKeyTooShortException;

/**
 * Class AuthService
 */
class AuthService
{
    protected Gateway $gateway;

    public string|null $mobile = null;
    public string|null $code = null;
    public string|null $password = null;
    public bool $otpForce = false;

    public function __construct()
    {
        $factory = new AuthFactory();
        $this->gateway = $factory->creator(config('general.auth'));
    }

    /**
     * @return JsonResponse
     * @throws IncompatibleWithGoogleAuthenticatorException
     * @throws InvalidCharactersException
     * @throws SecretKeyTooShortException
     */
    public function serviceController(): JsonResponse
    {
        if ($this->code) {
            $user = User::where('mobile', $this->mobile)->firstOrFail();
            return $this->gateway->otp($this->code, $user);
        } else {
            $user = User::where('mobile', $this->mobile)->withTrashed()->first();
            if ($user) {
                if ($user->trashed()) {
                    return response()->forbidden(__('auth.deletedUserError'));
                } else {
                    return $this->gateway->login($user, $this->password, $this->otpForce);
                }
            } else {
                return $this->gateway->register($this->mobile);
            }
        }
    }

    /**
     * @return JsonResponse
     */
    public function resetPassword() :JsonResponse
    {
        $user = User::where('mobile', $this->mobile)->firstOrFail();

        if (isset($this->code) && isset($this->password)) {
            return $this->gateway->resetPassword($user, $this->code, $this->password);
        } else {
            return $this->gateway->resetPassword($user);
        }
    }

    /**
     * @return JsonResponse
     * @throws IncompatibleWithGoogleAuthenticatorException
     * @throws InvalidCharactersException
     * @throws SecretKeyTooShortException
     */
    public function resetGoogle2fa() :JsonResponse
    {
        $user = User::where('mobile', $this->mobile)->firstOrFail();
        return $this->gateway->resetGoogle2fa($user, $this->code);
    }

    /**
     * @return JsonResponse
     */
    public function setPassword() :JsonResponse
    {
        return $this->gateway->setPassword($this->password);
    }
}
