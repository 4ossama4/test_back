<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $guarded = [];  

    public function cours(){
        return $this->hasMany(Course::class);
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
