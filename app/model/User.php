<?php

namespace App\model;

use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class User extends Model
{
//    use HasApiTokens,Notifiable;
    /**
     * 规定表名、主键
     * 维护时间戳
     * @var string
     */
    protected $table = 'users';
    protected $primaryKey = 'uid';
    public $timestamps = true;

    /**
     * 以下字段可插入
     * @var array
     */
    protected $fillable = [
        'username',
        'password',
        'phone',

    ];

    /**
     * 以下字段隐藏显示
     * @var array
     */
    protected $hidden = [
        'password',
    ];
}
