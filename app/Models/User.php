<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'nickname',
        'avatar',
        'phone_no',
        'city',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<string>
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
     * Define the relationship with the UserRole model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(UserRole::class, 'role_id', 'role_id');
    }

    /**
     * Check if the user has a specific permission.
     *
     * @param string $permission
     * @return bool
     */
    public function hasPermission(string $permission): bool
    {
        // Ensure the role relationship is loaded
        $role = $this->role;

        // If no role is assigned, return false
        if (!$role) {
            return false;
        }

        // Check if the role has the specified permission
        return $role->permissions()->where('description', $permission)->exists();
    }

    /**
     * Define the relationship with the Todo model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function todos()
    {
        return $this->hasMany(Todo::class, 'user_id', 'id');
    }
}