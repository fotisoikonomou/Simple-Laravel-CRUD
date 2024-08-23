<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class DvUser extends Authenticatable
{

    use Notifiable;
    use HasFactory; // create an instance of model for testing by inserting multiple data for testing

    // Declare  table name to avoid name collision 
    protected $table = 'dv_users';

    // Disable the Laravel's timestamps management and manually handle timestamp not automatically by laravel! 
    public $timestamps = false;


    protected $hidden = [
        'password', 'remember_token',
    ];

    // Define fillable properties for mass assignment for an example: update
    protected $fillable = [
        'name',
        'username',
        'password',
        'email',
        'is_active',
        'wp_users_ID',
        'date_created',
        'last_changed'
    ];

    // Eloquent

    /**
     * The roles that belong to the user. For an example a user might be both Manager  and Technical admin. So we 
     * use the pivot table to declare a user in many roles. If we had just a foreign key one then for an example 
     *  a user called fotis would be assigned with only one user role! That's why I use many to many relationship
     * and this I understood it from the database shema!
     */
    public function roles()
    {
        return $this->belongsToMany(DVUserRole::class, 'dv_users_roles_has_dv_users', 'dv_users_id', 'dv_users_roles_id');
    }

    public function wpUser()
    {
        return $this->belongsTo(WpUser::class, 'wp_users_ID', 'ID');
    }
}
