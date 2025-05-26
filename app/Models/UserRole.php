<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;

    protected $table = 'user_roles'; // Ensure this matches your database table name
    protected $primaryKey = 'role_id'; // Ensure this matches your primary key column

    protected $fillable = [
        'role_name',
        'description',
    ];

    /**
     * Define the relationship with the RolePermission model.
     */
    public function permissions()
    {
        return $this->belongsToMany(RolePermission::class, 'role_permission', 'role_id', 'permission_id');
    }
}