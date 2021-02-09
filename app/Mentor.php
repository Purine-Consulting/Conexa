<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class Mentor extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'mentor';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        ''
    ];

    /**
     * Retourne l'applicant
     */
    public function applicant()
    {
        return $this->belongsTo('\App\Applicant', 'id');
    }

    /**
     * Avoir les sessions d'un mentor
     */
    public function sessions()
    {
        return $this->hasMany('\App\Session', 'mentor');
    }

    /**
     * Avoir les notes d'un mentor
     */
    public function marks()
    {
        return $this->hasMany('\App\Mark', 'mentor');
    }
}
