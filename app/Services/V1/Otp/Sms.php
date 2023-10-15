<?php

namespace App\Services\V1\Otp;

use App\Models\User;
use App\Models\Verification;
use Illuminate\Http\JsonResponse;

class Sms implements Gateway
{
    /**
     * @param User $user
     * @return JsonResponse
     */
    public function init(User $user): JsonResponse
    {
        return $this->notify($user);
    }

    /**
     * @param User $user
     * @return JsonResponse
     */
    public function send(User $user): JsonResponse
    {
        return $this->notify($user);
    }

    /**
     * @param string $code
     * @param User $user
     * @return bool
     */
    public function verify(string $code, User $user): bool
    {
        if (env('APP_ENV') !== 'production' && ($user->mobile === config('app.mobile_number_test_1') || $user->mobile === config('app.mobile_number_test_2'))) {
            return true;
        }

        return Verification::verifyCode($code, $user);
    }

    /**
     * @param User $user
     * @return JsonResponse
     */
    private function notify(User $user)
    {
        $code = Verification::generateCode($user);
//        $user->notify(new \App\Notifications\V1\Otp($code, $user->mobile));

        return response()->json([
            'status' => true,
            'message' => 'sms-' . config('general.auth'),
        ], 200);
    }
}
