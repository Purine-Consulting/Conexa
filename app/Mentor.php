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

    /**
     * Retourne les aptitudes
     */
    public function skills()
    {
        return $this->belongsToMany('\App\Skill', 'mentor_skill', 'mentor', 'skill');
    }

    /**
     * Retourne les domaines de compétence
     */
    public function areas()
    {
        return $this->belongsToMany('\App\Area', 'area_mentor', 'mentor', 'area');
    }
}
