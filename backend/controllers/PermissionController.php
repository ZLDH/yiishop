<?php

namespace backend\controllers;

use backend\models\AuthItem;

class PermissionController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $authManager = \Yii::$app->authManager;
        $permissions =$authManager->getPermissions();
//        var_dump($permissions);exit;
        return $this->render('index',compact('permissions'));
    }
    /*
        * 添加权限
        */
    public function actionAdd()
    {
        $model = new AuthItem();
        $request=\Yii::$app->request;
        if ($model->load($request->post()) && $model->validate()){
            //实例化RBAC组合
            $authManager = \Yii::$app->authManager;
            //创建权限
            $permission= $authManager->createPermission($model->name);
            //添加描述
            $permission->description=$model->description;
            //添加权限到数据库
            $authManager->add($permission);
            \Yii::$app->session->setFlash("success","创建".$model->description."成功");
            return $this->refresh();
        }
//        var_dump($model->getErrors());exit;
        return $this->render('add',compact('model'));
    }


    /*
     * 修改权限
     */
    public function actionEdit($name)
    {
        //$model=new  AuthItem();
        $model=AuthItem::findOne($name);
        $request=\Yii::$app->request;
        if ($model->load($request->post()) && $model->validate()){
            $authManager=\Yii::$app->authManager;
            //找出当前权限对象
            $permission=$authManager->getPermission($model->name);
            if ($permission){
                //添加描述
                $permission->description=$model->description;
                //修改权限 把权限修改到数据库
                $authManager->update($model->name,$permission);
                \Yii::$app->session->setFlash("success","修改".$model->description."成功");
                return $this->redirect(['index']);
            }else{
                \Yii::$app->session->setFlash("danger","不能修改权限名称".$model->name);
                return $this->refresh();
            }
        }
        //var_dump($model->getErrors());exit;
        return $this->render("add",compact('model'));
    }
    //删除权限
    public function actionDel ($name){
        $auth=\Yii::$app->authManager;
        $permission = $auth->getPermission($name);
        //删除
        if ($auth->remove($permission)){
            \Yii::$app->session->setFlash("seccess","删除".$name."成功");
            return $this->redirect(['index']);
        }
    }
}
