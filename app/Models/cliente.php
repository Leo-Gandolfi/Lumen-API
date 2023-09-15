<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Cliente extends Model
{
    protected $table = 'tbl_cliente'; 
    protected $fillable = ['nome', 'email', 'senha']; 

    public function ordensServico()
    {
        return $this->hasMany(OrdemServico::class);
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
