<?php

namespace backend\controllers;

use backend\models\ArticleCategory;

class ArticlecategoryController extends \yii\web\Controller
{
    public function actionIndex()
    {
       $articlecategorys = ArticleCategory::find()->all();
        return $this->render('index',['articlecategorys'=>$articlecategorys]);
    }
//添加分类
    public function actionAdd()
    {
        //创建对象
        $articlecategory=new ArticleCategory();
        $request=\Yii::$app->request;
        if ($articlecategory->load($request->post())){
            if ($articlecategory->validate()){
                //保存数据
                if ( $articlecategory->save()){
                    //跳转
                    \Yii::$app->session->setFlash("success","添加成功");
                    return  $this->redirect(['index']);
                }
            }
        }
        //显示视图
        $articlecategory->status=1;
        $articlecategory->is_help=1;
        return $this->render("add", ['articlecategory' => $articlecategory]);
    }
    //修改分类
    public function actionEdit($id)
    {
        //创建对象
        $articlecategory=ArticleCategory::findOne($id);
        $request=\Yii::$app->request;
        if ($articlecategory->load($request->post())){
            if ($articlecategory->validate()){
                //保存数据
                if ( $articlecategory->save()){
                    //跳转
                    \Yii::$app->session->setFlash("success","修改成功");
                    return  $this->redirect(['index']);
                }
            }
        }
        //显示视图
        $articlecategory->status=1;
        $articlecategory->is_help=1;
        return $this->render("add", ['articlecategory' => $articlecategory]);
    }

    public function actionDel($id)
    {
        $articlecategory=ArticleCategory::findOne($id);
        $articlecategory->delete();
        \Yii::$app->session->setFlash("success","删除成功");
        return $this->redirect("index");
    }

}
