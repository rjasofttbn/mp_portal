<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/*
       Author: Rajan Bhatta
      Created Date: 05-02-2021

  */

class Application extends Model
{
        use SoftDeletes;

   // protected $table = "applications";
    //protected $with = ['applicationType', 'applicant'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'date', 'subject', 'application_type_id', 'description', 'status', 'created_by','updated_by'
    ];


    // Crated by Rajan Bhatta.
    // Foreign key relation with ApplicationType table.
    public function applicationType() {
        return $this->belongsTo(ApplicationType::class, 'application_type_id');
    }

    public function applicant() {
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
