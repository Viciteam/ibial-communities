<?php

namespace App\Data\Models\Company;


use App\Data\Models\BaseModel;

class BusinessModel extends BaseModel
{
    public $timestamps = true;
    public $incrementing = true;
    protected $table = 'business_info';

    public $casts = [
        'id' => 'int'
    ];

    public $fillable = [
        'name',
        'business_id',
        'description',
        'hashtag',
        'location',
        'skills',
        'language',
        'attributes',
    ];

    public $hidden = [];

    public $rules = [
        'name' => 'sometimes|required',
        'business_id' => 'sometimes|required',
        'description' => 'sometimes|required',
        'hashtag' => 'sometimes|required',
        'location' => 'sometimes|required',
        'skills' => 'sometimes|required',
        'language' => 'sometimes|required',
        'attributes' => 'sometimes|required',
    ];

     public function transactions()
     {
         return $this->morphMany();
     }
}
