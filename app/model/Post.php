<?php
/**
 * Created by PhpStorm.
 * User: CoooooL
 * Date: 2018/4/14
 * Time: 16:48
 */

namespace App\model;


use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $primarykey = 'id';
    public $timestamp = true;

    protected $fillable = [
        'title',
        'content',
        'img_name',
        'img_local_path',
        'img_url',
        'type',
    ];

}