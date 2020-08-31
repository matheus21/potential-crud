<?php

namespace App\Domain\Model;


use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    protected $table = 'developers';
    protected $primaryKey = 'id';
    protected $hidden = ['created_at', 'updated_at'];

    protected $fillable = [
        'nome',
        'sexo',
        'idade',
        'hobby',
        'datanascimento'
    ];
}
