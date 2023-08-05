<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\JsonResponse;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * @return HasMany
     */
    public function verification() : HasMany
    {
        return $this->hasMany(Verification::class);
    }

    /**
     * @return JsonResponse
     */
    public function generateToken() : JsonResponse
    {
        Auth::login($this);
        return response()->json([
            'status' => true,
            'message' => 'User Logged In Successfully'
        ]);
    }

    /**
     * @param User|null $user
     * @return string
     */
    public static function nameOrMobile(User $user = null): string
    {
        if ($user) {
            return empty($user->name) ? optional($user)->mobile : optional($user)->name;
        } else {
            $user = Auth::user();
            return empty($user->name) ? $user->mobile : $user->name;
        }
    }

    /**
     * @return string
     */
    public function staredNameOrMobile(): string
    {
        return empty($this->name) ? substr_replace($this->mobile, '****', 5, 4) : $this->name;
    }
}
