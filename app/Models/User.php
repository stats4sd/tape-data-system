<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Models\Contracts\HasTenants;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Stats4sd\FilamentOdkLink\Models\TeamManagement\Traits\HasTeamMemberships;

class User extends Authenticatable implements FilamentUser, HasAvatar, HasTenants
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasRoles;
    use HasTeamMemberships;

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }

    // ****** FILAMENT PANEL STUFF ******

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }

    public function getFilamentAvatarUrl(): ?string
    {
        return $this->avatar_url ? Storage::url($this->avatar_url) : null;
    }

    // ****** MULTI-TENANCY STUFF ******

    // Admin users can access all teams
    public function canAccessTenant(Model $tenant): bool
    {
        return $this->can('view all teams') || $this->teams->contains($tenant);
    }

    public function getTenants(Panel $panel): array|Collection
    {
        return $this->can('view all teams') ? Team::all() : $this->teams;
    }

    // ******* RELATIONSHIPS

    public function imports(): HasMany
    {
        return $this->hasMany(Import::class);
    }
}
