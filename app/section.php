<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class section extends Model
{
   protected $fillable = [
      'section_name', 'description', 'Created_by',
   ];
   public $timestamps = false ;
}
