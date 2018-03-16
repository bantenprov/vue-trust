<?php namespace Bantenprov\VueTrust\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * The VueTrustModel class.
 *
 * @package Bantenprov\VueTrust
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class VueTrustModel extends Model
{
    /**
    * Table name.
    *
    * @var string
    */
    protected $table = 'vue_trust';

    /**
    * The attributes that are mass assignable.
    *
    * @var mixed
    */
    protected $fillable = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
}
