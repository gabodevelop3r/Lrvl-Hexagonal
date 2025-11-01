<?php

namespace Src\Application\User\Infrastructure\Repositories\Eloquent\Models;
use Illuminate\Database\Eloquent\Model;

final class User extends Model {

    protected $table = "users";

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'cellphone',
        'password',
        'state_id',
    ];


}
