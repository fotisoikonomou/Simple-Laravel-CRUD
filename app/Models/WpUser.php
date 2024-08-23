<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WpUser extends Model
{
    use HasFactory;

    protected $table = 'wp_users';

    protected $primaryKey = 'ID';

    protected $fillable = [
        'user_login',
        'user_pass',
        'user_email',
        'user_nicename',
        'user_url',
        'user_registered',
        'user_activation_key',
        'user_status',
        'display_name'
    ];

    public function dvUsers()
    {
        return $this->hasMany(DvUser::class, 'wp_users_ID', 'ID');
    }
}
