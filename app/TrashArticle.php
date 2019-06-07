<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrashArticle extends Model
{
    public $table = 'temp_trash_posts';


    public  function user ()
    {
        return $this->belongsTo('App\User');
    }

    public  function category ()
    {
        return $this->belongsTo('App\Category');
    }

}
