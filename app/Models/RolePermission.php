<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    use HasFactory;

    protected $primaryKey = 'permission_id'; // Set the primary key to 'permission_id'

    protected $fillable = [
        'role_id',
        'description',
    ];

    /**
     * Define the relationship with the UserRole model.
     */
    public function role()
    {
        return $this->belongsTo(UserRole::class, 'role_id', 'role_id');
    }
}