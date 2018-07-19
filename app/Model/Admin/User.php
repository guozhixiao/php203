<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //
     /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'user';

    protected $sprimaryKey = 'id';

    public  $timestamps = false;

     /**
     * 可以被批量赋值的属性。
     *
     * @var array
     */
    protected $fillable = ['username','password','phone','mail','profile','status'];
}
