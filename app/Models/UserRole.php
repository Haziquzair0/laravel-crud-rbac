<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;

    protected $primaryKey = 'role_id';

    protected $fillable = ['user_id', 'role_name', 'description'];

    /**
     * Define the relationship with RolePermission.
     */
    public function permissions()
    {
        return $this->hasMany(\App\Models\RolePermission::class, 'role_id', 'role_id');
    }
}