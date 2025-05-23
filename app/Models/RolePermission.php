<?php
// app/Models/RolePermission.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    protected $primaryKey = 'permission_id';
    protected $fillable = ['role_id', 'description'];
}