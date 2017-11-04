<?php

namespace backend\controllers;

use backend\models\ArticleDetail;

class ArticleDetailController extends \yii\web\Controller
{
    public function actionIndex($id)
    {
        $articledetails = ArticleDetail::findOne($id);
        return $this->render('index',['articledetails'=>$articledetails]);
    }

}
