<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;

class Goodsimg extends Model
{
    //
     /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'goodsimg';

    protected $sprimaryKey = 'id';

    public  $timestamps = false;

     /**
     * 可以被批量赋值的属性。
     *
     * @var array
     */
    protected $fillable = ['gid','gpic'];
}
