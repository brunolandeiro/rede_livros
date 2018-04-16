<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Musicas extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'musica';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'nome', 'cantor', 'letra', 'img', 'youtube'
    ];

}
