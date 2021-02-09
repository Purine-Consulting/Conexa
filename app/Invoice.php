<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class Invoice extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'invoice';
    protected $attributes = [
        'status' => 1
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lib', 'amount', 'mentee'
    ];

    /**
     * Avoir les paiements d'une facture
     */
    public function payments()
    {
        return $this->hasMany('\App\Payment', 'invoice');
    }

    /**
     * Avoir le mentor d'une facture
     */
    public function mentee()
    {
        return $this->belongsTo('\App\Mentee', 'mentee');
    }
}
