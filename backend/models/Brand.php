<?php
namespace backend\models;
use Yii;
/**
 * This is the model class for table "brand".
 *
 * @property integer $id
 * @property string $name
 * @property string $intro
 * @property string $logo
 * @property integer $sort
 * @property integer $status
 */
class Brand extends \yii\db\ActiveRecord
{
    public static $statusText=['0'=>'隐藏','1'=>'显示'];
    public $imgFile;

    public static function tableName()
    {
        return 'brand';
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['sort', 'status'], 'integer'],
            [['name'], 'string', 'max' => 30],
            [['intro'], 'string', 'max' => 255],
            [['imgFile'],'file','extensions' => ['gif','jpg','png'],'skipOnEmpty' => true]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'intro' => '简介',
            'sort' => '排序',
            'status' => '状态',
        ];
    }
}