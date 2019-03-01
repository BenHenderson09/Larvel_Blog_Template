<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // Define table name. By default, `posts` is assumed as the table name by the framework.
    public $tablename = 'posts';

    // Primary key. Framework will automatically set it to `id`.
    public $primaryKey = 'id'; 

    // Automatically insert timestamp data. Default is true.
    public $timestamps = true;

    // Gets the author of the post using a relationship
    public function user(){
        return $this->belongsTo('App\User');
    }
}
