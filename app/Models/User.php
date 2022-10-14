<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role',
        'name',
        'code',
        'place',
        'email',
        'manager',
        'password',
        'leader_user_id',
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
    ];

    /**
     * @param string $role
     * @return bool
     */
    public function hasRole(string $role): bool
    {
        return $this->getAttribute('role') === $role;
    }

    ////////////RELATIONSHIPS
    public function qrs(): HasMany
    {
        return $this->hasMany(Qr::class, 'user_id', 'id');
    }

    ////////////OTHERS
    public function ultimoQr(): HasOne
    {
        return $this->hasOne(Qr::class, 'user_id', 'id')->latest();
    }

    ///SCOPES
    public function scopeSearchList($query, $cSearch)
    {
        if($cSearch !== null)
            return $query->where('name', 'LIKE', "%$cSearch%")
                        ->orWhere('code','LIKE',"%$cSearch%");
        else
            return $query;
    }
}
