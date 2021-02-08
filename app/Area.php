<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class Area extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'area';

    /**
     * Retourne les applicants étant dans ce domaine
     */
    public function mentors()
    {
        return $this->belongsToMany('\App\Applicant', 'applicant_area', 'area', 'applicant')->withTimestamps();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lib'
    ];
}
