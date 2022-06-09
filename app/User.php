<?php

namespace App;

use App\Model\MpPs;
use App\Model\Profile;
use App\Model\UserRole;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'usertype'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['ps_of_mp'];

    public function user_role()
    {
        return $this->hasMany(UserRole::class, 'user_id', 'id');
    }

    public function psMpInfo()
    {
        return $this->hasOne(MpPs::class, 'ps_user_id', 'id');
    }

    public function mpProfile()
    {
        return $this->hasOne(Profile::class, 'user_id', 'id');
    }

    public function getPsOfMpAttribute()
    {
        if ($this->psMpInfo) {
            $mpUser = User::find($this->psMpInfo->mp_user_id);
            return $mpUser->name;
        }
    }

    /* for JWT authentication */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
}
