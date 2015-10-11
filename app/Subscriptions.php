<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscriptions extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'subscriptions';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['email'];

}
