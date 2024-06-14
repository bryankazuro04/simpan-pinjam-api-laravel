<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Model implements AuthenticatableContract
{
    use HasApiTokens, Notifiable, Authenticatable;

    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    public function anggota(): HasMany
    {
        return $this->hasMany(Anggota::class, 'user_id', 'id');
    }

    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
        return $this->getAttribute('remember_token');
    }

    public function setRememberToken($value)
    {
        $this->setAttribute('remember_token', $value);
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }
}
