<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'phone', 'password'];

}
