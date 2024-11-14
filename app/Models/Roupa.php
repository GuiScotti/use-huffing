<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Roupa extends Model
{
    protected $fillable = [
        'nome',
        'descrição',
        'preço',
        'quantidade',
        'imagem'
    ];

    public function favoritadoPor()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }

}
