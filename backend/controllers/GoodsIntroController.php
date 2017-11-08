<?php

namespace backend\controllers;

use backend\models\GoodsGallery;
use backend\models\GoodsIntro;

class GoodsIntroController extends \yii\web\Controller
{
    public function actionIndex($id)
    {
        $goodIntro = GoodsIntro::findOne($id);
        if ($goodIntro == null){
            exit("没有内容,请添加内容!!");
        }
        $goodsImg = GoodsGallery::find()->all();
        return $this->render('index',['goodIntro'=>$goodIntro,'goodsImgs'=>$goodsImg,'id'=>$id]);
    }

}
