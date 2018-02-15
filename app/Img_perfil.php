<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Img_perfil extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_img_perfil', 'nome_img', 'fk_user_id'
    ];

    public function usuario() {
        return $this->belongsTo(User::class, 'fk_user_id', 'id');
    }

}
