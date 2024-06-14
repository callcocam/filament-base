<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Filament\Panel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Jeffgreco13\FilamentBreezy\Traits\TwoFactorAuthenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable  implements FilamentUser, HasAvatar
{
    use   HasFactory, Notifiable, HasUlids, TwoFactorAuthenticatable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ]; 

    protected $with = ['featuredImage'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getUserAvatarAttribute()
    {
        return $this->getFilamentAvatarUrl();
    }

    public function getFilamentAvatarUrl(): ?string
    {
        return $this->avatar_url ;
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }
    
    public function featuredImage(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'logo', 'id');
    }
}
