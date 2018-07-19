<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    //
     /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'goods';

    protected $sprimaryKey = 'id';

    public  $timestamps = false;

     /**
     * 可以被批量赋值的属性。
     *
     * @var array
     */
    protected $fillable = ['gname','color','price','size','content','status','cateid'];

    public function type()
    {
        return $this->hasMany('App\Model\admin\Category','pid');
    }


    public function gs()
    {
        return $this->hasMany('App\Model\admin\Goodsimg','gid');
    }
}
