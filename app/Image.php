<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';
    protected $fillable = ['url','file_name'];
     
    public function imageable (){
    
        return $this->morphTo();
    }
}
