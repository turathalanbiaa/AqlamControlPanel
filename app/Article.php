<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public $table = 'posts';
    public $timestamps = false;
    public $fillable = ['status'];


    public function comment ()
    {
        return $this->hasMany('App\Comment', 'post_id')->with('user');
    }

    public  function user ()
    {
        return $this->belongsTo('App\User');
    }

    public  function category ()
    {
        return $this->belongsTo('App\Category');
    }

}
