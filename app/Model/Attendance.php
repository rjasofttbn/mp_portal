<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



/*
Author: Rajan Bhatta
   Created Date: 01-02-2021
*/

class Attendance extends Model
{
        use SoftDeletes;

    protected $table = "attendances";
    protected $with = ['parliament', 'parliamentSession', 'user', 'mp_profile'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parliament_id', 'session_id', 'user_id', 'date', 'status', 'created_by','updated_by'
    ];


    // Crated by Rajan Bhatta.
    // Foreign key relation with parliament table.
    public function parliament() {
        return $this->belongsTo(Parliament::class, 'parliament_id');
    }


    // Foreign key relation with parliament session table.
    public function parliamentSession() {
        return $this->belongsTo(ParliamentSession::class, 'session_id');
    }

    // Foreign key relation with users table.
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }


    // Foreign key relation with profile table.
    public function mp_profile() {
        return $this->belongsTo(Profile::class, 'user_id');
    }



    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'deleted_at'
    ];
}
