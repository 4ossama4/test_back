<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';
    protected $guarded = []; 

    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function image(){

        return $this->morphOne('App\Image', 'imageable');
    }

    public static function boot() {
        parent::boot();
        // create a event to happen on saving
        static::saving(function($table)  {
        
            $table->slug = str_slug($table->name);
        });
    }

}
