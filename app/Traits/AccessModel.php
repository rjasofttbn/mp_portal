<?php

namespace App\Traits;

trait AccessModel
{
    protected static function bootAccessModel()
    {
        if (auth()->check()) {
            static::creating(function ($model) {
                $model->created_by = authInfo()->id;
            });
            
            static::updating(function ($model) {
                $model->updated_by = authInfo()->id;
            });

            // static::addGlobalScope('created_by', function (Builder $builder) {
            //     $builder->where('created_by', authInfo()->id);
            // });
        }
    }
}