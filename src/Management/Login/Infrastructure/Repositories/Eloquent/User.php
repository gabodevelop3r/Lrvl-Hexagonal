<?php

namespace Src\Management\Login\Infrastructure\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Src\Application\Role\Infrastructure\Repositories\Eloquent\Role;

class User extends Model
{
    protected $table = "users";

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'cellphone',
        'password',
        'state_id',
    ];

    protected $hidden = [
        'password',
    ];


    public function roles() : BelongsToMany
    {
        return $this->belongsToMany(Role::class,'users_roles','user_id','role_id');
    }

}
