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
<<<<<<< HEAD
     * Avoir le grade d'un applicant
=======
     * Avoir les applicants ayant un certain niveau
>>>>>>> be5a0c9d0e966558575712f270e325a0e4342172
     */
    public function grade()
    {
        return $this->belongsTo('\App\Grade', 'grade');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'grade'
    ];
}
