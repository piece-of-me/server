<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int id
 * @property string login
 * @property string password
 * @property string firstname
 * @property string lastname
 * @property string|null birthdate
 * @property string register_at
 * @property string|null remember_token
 * @property string created_at
 * @property string updated_at
 */
class User extends Authenticatable
{
    use HasApiTokens, Notifiable, SoftDeletes;

    public $timestamps = true;

    public const LOGIN_MAX_LENGTH = 50;
    public const PASSWORD_MAX_LENGTH = 100;
    public const FIO_MAX_LENGTH = 50;
}
