<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class Payment extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'payment';

    /**
     * Avoir le mentor d'une facture
     */
    public function invoices()
    {
        return $this->belongsTo('\App\Invoice', 'invoice');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ref', 'date', 'invoice'
    ];
}
