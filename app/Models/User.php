<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Glorand\Model\Settings\Traits\HasSettingsField;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasSettingsField;

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

    public function communities() {
        return $this->belongsToMany(Community::class, 'community_user', 'user_id', 'community_id');
    }

    public function bets() {
        return $this->hasMany(Bet::class);
    }

    public function createdCommunities() {
        return $this->hasMany(Community::class, 'created_by');
    }
}
