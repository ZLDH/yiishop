<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/6 0006
 * Time: 下午 1:12
 */

namespace backend\models;


use yii\db\ActiveRecord;

class GoodsDel extends ActiveRecord
{
    public static function tableName()
    {
        return 'goods_category';
}
}