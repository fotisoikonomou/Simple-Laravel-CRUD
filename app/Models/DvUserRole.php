<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class DvUserRole extends Model
{
    use HasFactory;


    protected $table = 'dv_users_roles';


    public $timestamps = false;


    protected $fillable = [
        'name',
        'is_active',
        'date_created',
        'last_changed',
        'is_deleted'
    ];

    protected static function booted()
    {
        static::addGlobalScope('not_deleted', function (Builder $builder) {
            $builder->where('is_deleted', false);
        });
    }

       // Optional: Method to "soft delete" a role
       public function softDelete()
       {
           $this->is_deleted = true;
           $this->save();
       }
    public function users()
    {
        return $this->belongsToMany(DvUser::class, 'dv_users_roles_has_dv_users', 'dv_users_roles_id', 'dv_users_id');
    }
}
