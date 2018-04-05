<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'livro';
    protected $primaryKey = 'livro_id';
    public $timestamps = false;
    protected $fillable = [
        'titulo', 'autor', 'descricao', 'img', 'user_fk', 'estante'
    ];

    public function usuario() {
        return $this->belongsTo(User::class, 'user_fk', 'id');
    }

}
