<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Auth\Passwords\CanResetPassword;
use App\Notifications\ResetPasswordNotification;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    protected $fillable = [
        'name',
        'name_social',
        'email',
        'cpf',
        'password',
        'tipo_usuario',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    public function typage()
    {
        return $this->morphTo();
    }

    public static $rules = [
        'name' => 'bail|required|min:10|max:100|regex:/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ\' ]+$/',
        'email' => 'bail|required|email|max:100|unique:users|unique:professors',
        'password' => 'bail|required|min:8|max:30'
    ];

    public static $messages = [
        'name.required' => 'Nome é obrigatório',
        'name.min' => 'Nome deve possuir no mínimo 10 caracteres',
        'name.max' => 'Nome deve possuir no máximo 100 caracteres',
        'name.regex' => 'Nome deve conter apenas letras',
        'email.required' => 'E-mail é obrigatório',
        'email.email' => 'E-mail inválido',
        'email.max' => 'E-mail deve possuir no máximo 100 caracteres',
        'email.unique' => 'E-mail já cadastrado',
        'password.required' => 'Senha é obrigatória',
        'password.min' => 'Senha deve possuir no mínimo 8 caracteres',
        'password.max' => 'Senha deve possuir no máximo 30 caracteres'
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token, $this->name));
    }

}
