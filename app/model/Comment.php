<?php
/**
 * Created by PhpStorm.
 * User: CoooooL
 * Date: 2018/4/26
 * Time: 10:40
 */

namespace App\model;


use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $primaryKey = 'id';
    public $timestamp = true;

    protected $fillable = [
        'pId',
        'username',
        'content',
    ];

}