<?php

namespace backend\controllers;

use backend\models\GoodsCategory;
use backend\models\GoodsDel;
use yii\data\ActiveDataProvider;
use yii\helpers\Json;

class GoodsCategoryController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $cates = GoodsCategory::find();
        $dataProvider = new ActiveDataProvider([
            'query'=>$cates,
        ]);
        return $this->render('index',['dataProvider'=>$dataProvider]);
    }

    /**
     * 添加商品分类
     */
    public function actionAdd()
    {
        $model = new GoodsCategory();
        $models = GoodsCategory::find()->all();
        $request=\Yii::$app->request;
        if ($request->isPost){
        //数据绑定
            $model->load($request->post());
            if ($model->validate()){
                if ($model->parent_id==0){
                    $model->makeRoot();
                    \Yii::$app->session->setFlash("success","添加一级目录成功");
                }else{
                    //创建子分类
                    //找父类节点
                    $cateparent=GoodsCategory::findOne(['id'=>$model->parent_id]);
                        //把当前节点独享添加到父类对象中
                    $model->prependTo($cateparent);
                }
                \Yii::$app->session->setFlash("success","添加目录成功");
                return $this->redirect(['index']);
            }

        }
        //得到所有分类

        //x显示视图
        $cates=GoodsCategory::find()->asArray()->all();
        $cates[]=['id'=>0,'parent_id'=>0,'name'=>'顶级分类'];

       // var_dump($cates);exit;
        $cates=Json::encode($cates);
        return $this->render("add",['model'=>$model,'cates'=>$cates]);
    }
    /**
     * 添加商品分类
     */
    public function actionEdit($id)
    {
        $model = GoodsCategory::findOne($id);
        $models = GoodsCategory::find()->all();
        $request=\Yii::$app->request;
        if ($request->isPost){
            //数据绑定
            $model->load($request->post());
            if ($model->validate()){
                if ($model->parent_id==0){
                    $model->makeRoot();
                    \Yii::$app->session->setFlash("success","修改一级目录成功");
                }else{
                    //创建子分类
                    //找父类节点
                    $cateparent=GoodsCategory::findOne(['id'=>$model->parent_id]);
                    //把当前节点独享添加到父类对象中
                    $model->prependTo($cateparent);
                }
                \Yii::$app->session->setFlash("success","修改目录成功");
                return $this->redirect(['index']);
            }

        }
        //得到所有分类
        $cates=GoodsCategory::find()->asArray()->all();
        $cates[]=['id'=>0,'parend_id'=>0,'name'=>'顶级分类'];
        $cates=Json::encode($models);
        //x显示视图
        return $this->render("add",['model'=>$model,'cates'=>$cates]);

    }

    //删除
    public function actionDel($id)
    {
        $cate = GoodsCategory::findOne(['parent_id'=>$id]);
        if ($cate!=null){
            \Yii::$app->session->setFlash('success',"文件内含子节点，不能删除，请先删除子节点");
            return $this->redirect(['index']);
        }else{
            $cate=GoodsCategory::findOne($id);
            if ($cate->depth==0){
                    GoodsDel::findOne($id)->delete();
            }else{
                GoodsCategory::findOne($id)->delete();
            }
            \Yii::$app->session->setFlash('success',"删除成功");
            return $this->redirect(['index']);
        }
    }
}
