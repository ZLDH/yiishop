<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "article".
 *
 * @property integer $id
 * @property string $name
 * @property integer $article_category_id
 * @property string $intro
 * @property string $status
 * @property string $sort
 * @property integer $inputtime
 */
class Article extends \yii\db\ActiveRecord
{
    public function getArticleCategory(){
        //1对1
        return $this->hasOne(ArticleCategory::className(),['id'=>'article_category_id']);
    }

    public static $statusText=['0'=>'否','1'=>'是'];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'sort'], 'required'],
            [['article_category_id'], 'integer'],
            [['intro', 'status'], 'string'],
            [['name'], 'string', 'max' => 50],
            [['sort'], 'string', 'max' => 8],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'article_category_id' => '文章分类',
            'intro' => '简介',
            'status' => '状态',
            'sort' => '排序',
            'inputtime' => '添加时间',
        ];
    }
}
