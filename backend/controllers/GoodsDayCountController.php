<?php

namespace backend\controllers;

use backend\models\GoodsDayCount;

class GoodsDayCountController extends \yii\web\Controller
{
    public function actionIndex()
    {
      $daycount =GoodsDayCount::find()->all();
        return $this->render('index',['daycounts'=>$daycount]);
    }

    //修改
    public function actionEdit($id)
    {
        //创建对象
        $daycount=GoodsDayCount::findOne($id);
        $request=\Yii::$app->request;
        if ($daycount->load($request->post())){
            if ($daycount->validate()){
                //保存数据
                if ( $daycount->save()){
                    //跳转
                    return  $this->redirect(['index']);
                }
            }
        }
        //显示视图
        return $this->render("edit", ['daycount' => $daycount]);
    }

}
