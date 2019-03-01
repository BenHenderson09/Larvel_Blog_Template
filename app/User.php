<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class User extends Authenticatable
{
    use Notifiable;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     *  One to many relationship. Laravel dynamically links these up to the SQL structure
     *  based on the names of the models, tables and id columns.
     * 
     *  Also, Laravel has dynamic properties allow as to access the posts like this, `User::find($id)->posts;`
     */
    public function posts(){
        // Will go the posts table and get all posts that have the user ud in a column named `user_id`
        // This will also work: `$this->hasMany('App\Post', 'user_id');`
        return $this->hasMany('App\Post');
    }

    public function removePasswordResets(){
        DB::table('password_resets')->where('email', $this->email)->delete();
    }
}
