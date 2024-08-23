<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class DvUsersRoleUser extends Pivot
{
    use HasFactory;

    protected $table = 'dv_users_roles_has_dv_users';

    // Composite primary key as described
    protected $primaryKey = ['dv_users_roles_id', 'dv_users_id'];

    // Disable auto-incrementing of the primary key
    public $incrementing = false;

    // Disable Laravel's timestamps management because I manually fill them
    public $timestamps = false;
}
