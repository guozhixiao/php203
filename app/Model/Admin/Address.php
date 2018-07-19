<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //
     /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'address';

    protected $sprimaryKey = 'id';

    public  $timestamps = false;

     /**
     * 可以被批量赋值的属性。
     *
     * @var array
     */
    protected $fillable = ['oid','oname','oprass','phone'];

   
}
