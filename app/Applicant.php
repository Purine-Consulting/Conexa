<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class Applicant extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'applicant';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'grade'
    ];

    /**
     * Relation avec Mentor
     */
    public function mentors()
    {
        return $this->hasMany('\App\Mentor', 'id');
    }

    /**
     * Relation avec Mentoré
     */
    public function mentees()
    {
        return $this->hasMany('\App\Mentee', 'id');
    }

    /**
     * Avoir le grade d'un applicant
     */
    public function grade()
    {
        return $this->belongsTo('\App\Grade', 'grade');
    }

    /**
     * Retourne les aptitudes
     */
    public function skills()
    {
        return $this->belongsToMany('\App\Skill', 'applicant_skill', 'applicant', 'skill')->withTimestamps();
    }

    /**
     * Retourne les domaines de compétence
     */
    public function areas()
    {
        return $this->belongsToMany('\App\Area', 'applicant_area', 'applicant', 'area')->withTimestamps();
    }
}
