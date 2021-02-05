<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class Session extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'session';

    /**
     * Avoir les activités d'une session
     */
    public function activities()
    {
        return $this->hasMany('\App\Activity', 'session');
    }

    /**
     * Avoir le mentor d'une session
     */
    public function mentee()
    {
        return $this->belongsTo('\App\Mentee', 'mentee');
    }

    /**
     * Avoir le mentor d'une session
     */
    public function mentor()
    {
        return $this->belongsTo('\App\Mentor', 'mentor');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date'
    ];
}
