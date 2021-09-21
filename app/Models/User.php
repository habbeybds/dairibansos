<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'usergroupid',
        'first_name',
        'last_name',
        'username',
        'no_hp',
        'email',
        'no_hp',
        'password',
        'remember_token',
        'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getListDataAgen()
    {
        return $this->select('users.*', 'ug.level')->join('usergroups as ug', 'ug.id', '=', 'users.usergroupid')->where('users.usergroupid','2')->orderBy('users.id', 'DESC')->get();
    }

}
