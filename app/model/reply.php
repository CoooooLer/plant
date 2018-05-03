<?php
/**
 * Created by PhpStorm.
 * User: CoooooL
 * Date: 2018/5/2
 * Time: 9:09
 */

namespace App\model;


use Illuminate\Database\Eloquent\Model;

class reply extends Model
{
    protected $table = 'replys';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'pId',
        'cId',
        'username',
        'content',
        'toUsername',
    ];


}