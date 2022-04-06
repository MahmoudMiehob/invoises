<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class products extends Model
{

    protected $guarded = [];
    public $timestamps = false ;

    public function section()
    {
        return $this->belongsTo('App\section');
    }
}
