<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends Model
{
    use HasFactory;

    protected $table    = 'roles';
    protected $fillable = ['name'];
    protected $appends  = ['users_count'];
    protected $casts    = ['created_at' => 'date:Y-m-d', 'updated_at' => 'date:Y-m-d H:i'];
    protected $dates    = ['created_at', 'updated_at'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function getNameAttribute($value)
    {
        $word = str_replace('_', ' ', $value);
        return ucwords($word);
    }

    public function getUsersCountAttribute()
    {
        // SELECT COUNT(role_id) as 'result' FROM model_has_roles GROUP BY role_id

        // Users Count
        $users = DB::table('model_has_roles')
            ->join('users', 'users.id', '=', 'model_has_roles.role_id')
            ->select('users.id', 'model_has_roles.role_id')
            ->get();

        $users = DB::table('model_has_roles')
            ->addSelect(DB::raw('COUNT(role_id) as result'))
            ->groupBy('role_id')
            ->count();

        $roles = SpatieRole::pluck('name');
        foreach ($roles as $role) {
            $userCount = User::whereHas('roles', function ($query) use ($role) {
                $query->where('name', $role);
            })->count();
        }
        return $users;
    }
}
