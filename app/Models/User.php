<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use BezhanSalleh\FilamentShield\Traits\HasPanelShield;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel as FilamentPanel;
use Filament\Tables\Columns\Layout\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

// use BezhanSalleh\FilamentShield\Traits\HasPanelShield;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'panelrole',
    ];

    public function canAccessPanel(FilamentPanel $panel): bool
    {

        switch (true) {

            case ($panel->getId() === 'admin'):
                if (auth()->user()->panelrole === 'admin') {
                    return true;
                } else {
                    return false;
                }

                break;

            case ($panel->getId() === 'tsn'):
                if (auth()->user()->panelrole === 'pengajar' || auth()->user()->panelrole === 'admin') {
                    return true;
                } else {
                    return false;
                }

                break;

            case ($panel->getId() === 'walisantri'):
                if (auth()->user()->panelrole === 'walisantri' || auth()->user()->panelrole === 'admin') {
                    return true;
                } else {
                    return false;
                }

                break;
        }


        // if (auth()->user()->panelrole === 'admin' && $panel->getId() === 'admin') {

        //     return true;
        // } elseif (auth()->user()->panelrole === 'pengajar' || auth()->user()->panelrole === 'admin' && $panel->getId() === 'tsn') {
        //     dd(auth()->user()->panelrole, $panel->getId());
        //     return true;
        // } elseif (auth()->user()->panelrole === 'walisantri' || auth()->user()->panelrole === 'admin'  && $panel->getId() === 'walisantri') {
        //     return true;
        // } {

        //     return false;
        // }
    }

    public function getRedirectRoute()
    {
        return match ((string)$this->panelrole) {
            'admin' => 'admin',
            'pengajar' => 'tsn',
            'walisantri' => 'walisantri',
        };
    }

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
        'mudirqism' => 'array',
        'role' => 'array',
    ];

    public function getRoleNamesAttribute(): string
    {
        return $this->roles->pluck('name')->join(',');
    }

    // public function walisantri()
    // {
    //     return $this->hasOne(Walisantri::class);
    // }

    // public function pengajar()
    // {
    //     return $this->hasOne(Pengajar::class);
    // }

    // public function pendaftar()
    // {
    //     return $this->hasOne(Pendaftar::class);
    // }

    public static function boot()
    {
        parent::boot();
        $user = Auth::user();

        if ($user === null) {
            return;
        } else {

            static::creating(function ($model) {
                $user = Auth::user();
                $model->created_by = $user->username;
                $model->updated_by = $user->username;
            });
            static::updating(function ($model) {
                $user = Auth::user();
                $model->updated_by = $user->username;
            });
        }
    }
}
