<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
     //
     /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'category';

    protected $sprimaryKey = 'id';

    public  $timestamps = false;

     /**
     * 可以被批量赋值的属性。
     *
     * @var array
     */
    protected $fillable = ['catename','pid','path'];
}

