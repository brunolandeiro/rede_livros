<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Lelivros extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'lelivros';
    protected $primaryKey = 'lelivros_id';
    public $timestamps = false;
    protected $fillable = [
        'titulo', 'autor', 'descricao', 'img', 'link', 'cat'
    ];

}
