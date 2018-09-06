<?php

namespace App\Auth\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Laravel\Passport\HasApiTokens;
use App\Core\Dao\SDB;
class User extends Authenticatable
{
    use Notifiable;
    use HasApiTokens;
    protected $table = 'users';//may be change table name
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id';
    protected $fillable = [
        'name', 'email', 'password','role_value'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function details() {
        return SDB::table('users_detail')->where(array('id',$this->getKey())) ;
    }
}
