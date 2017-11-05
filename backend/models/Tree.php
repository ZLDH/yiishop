<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/5 0005
 * Time: 上午 11:54
 */

namespace backend\models;


use yii\db\ActiveRecord;

class Tree extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tree';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'required'],
            [['description'], 'string'],
            [['parent_id'], 'integer']
        ];
    }

}