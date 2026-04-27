<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "name",
        "email",
        "password",
        "is_admin",
        "provider",
        "provider_id",
        "avatar",
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ["password", "remember_token"];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        "email_verified_at" => "datetime",
        "password" => "hashed",
        "is_admin" => "boolean",
    ];

    /**
     * Find or create a user from a social provider.
     */
    public static function findOrCreateFromSocial(
        string $provider,
        $socialUser,
    ): self {
        $existing = self::where("provider", $provider)
            ->where("provider_id", $socialUser->getId())
            ->first();

        if ($existing) {
            return $existing;
        }

        // Check if a user with this email already exists
        $user = self::where("email", $socialUser->getEmail())->first();

        if ($user) {
            // Link the social account to existing user
            $user->update([
                "provider" => $provider,
                "provider_id" => $socialUser->getId(),
                "avatar" => $socialUser->getAvatar(),
            ]);
            return $user;
        }

        // Create a brand new user
        return self::create([
            "name" => $socialUser->getName() ?? $socialUser->getNickname(),
            "email" => $socialUser->getEmail(),
            "password" => null,
            "provider" => $provider,
            "provider_id" => $socialUser->getId(),
            "avatar" => $socialUser->getAvatar(),
        ]);
    }

    public function isAdmin(): bool
    {
        return $this->is_admin;
    }

    /**
     * Get all favorites for this user.
     */
    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class);
    }

    /**
     * Check if the user has favorited a specific model.
     *
     * @param mixed $model The model to check
     * @return bool Whether the user has favorited the model
     */
    public function hasFavorited($model): bool
    {
        return Favorite::where("user_id", $this->id)
            ->where("favoritable_type", get_class($model))
            ->where("favoritable_id", $model->id)
            ->exists();
    }
}
