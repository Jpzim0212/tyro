<?php

namespace HasinHayder\Tyro\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    protected $hidden = ['pivot', 'created_at', 'updated_at'];

    protected $table = 'roles';

    public function users()
    {
        $userClass = config('tyro.models.user', config('auth.providers.users.model', 'App\\Models\\User'));

        return $this->belongsToMany($userClass, config('tyro.tables.pivot', 'user_roles'));
    }

    public function privileges(): BelongsToMany
    {
        return $this->belongsToMany(
            Privilege::class,
            config('tyro.tables.role_privilege', 'privilege_role')
        )->using(RolePrivilege::class)->withTimestamps();
    }
}
