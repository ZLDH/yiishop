<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/8 0008
 * Time: 下午 7:52
 */

namespace backend\models;


use yii\base\Model;

class GoodsSearchFrom extends Model
{
//    public $name;
//    public $sn;
    public $keyword;
    public $minPrice;
    public $maxPrice;

    public function rules()
    {
        return [
            [['minPrice','maxPrice'],'number'],
            ['keyword','safe']
        ]; // TODO: Change the autogenerated stub
    }

}