<?php

namespace App\Services\V1\Auth;

use App\Models\User;
use Illuminate\Http\JsonResponse;

/**
 * Interface Gateway
 */
interface Gateway
{
    public function login(User $user, string $password = null, bool $otpForce = null) : JsonResponse;
    public function register(string $mobile) : JsonResponse;
    public function otp(string $code, User $user) : JsonResponse;
    public function setPassword(string $password) : JsonResponse;
    public function resetPassword(User $user, string $code = null, string $password = null) : JsonResponse;
    public function resetGoogle2fa(User $user, string $code = null) : JsonResponse;
}
