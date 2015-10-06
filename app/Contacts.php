<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Contacts extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'contacts';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'phone', 'organization', 'message'];

}
