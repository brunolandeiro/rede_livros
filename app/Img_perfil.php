<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Img_perfil extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'img_perfil';
    protected $primaryKey = 'id_img_perfil';
    public $timestamps = false;
    protected $fillable = [
        'nome_img', 'fk_user_id'
    ];

    public function usuario() {
        return $this->belongsTo(User::class, 'fk_user_id', 'id');
    }

}
