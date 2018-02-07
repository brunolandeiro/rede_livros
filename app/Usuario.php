<?php
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable {

    use Notifiable;

    protected $table = 'usuario';
    public $timestamps = false;
    protected $fillable = [
        "nome",
        "email",
        "senha",
    ];
    protected $guarded = [
        'id'
    ];
    protected $hidden = [
        'senha',
        'remember_token',
    ];

}
?>
