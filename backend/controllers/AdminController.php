<?php

namespace backend\controllers;

use backend\models\Admin;
use common\models\LoginForm;

class AdminController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $admins = Admin::find()->all();
        return $this->render('index', ['admins' => $admins]);
    }
    /*
     * 登录
     */
    public function actionLogin()
    {

        //实例化表单模型
        $model = new LoginForm();
        //得到request对象
        $request = \Yii::$app->request;
        //判断是不是POST提交
        if ($request->isPost) {

            //1.接收数据并绑定到Model
            $model->load($request->post());
//            var_dump($model);exit();
            //2.后端验证
//            if ($model->validate()) {
//                var_dump($model);exit();
                if (Admin::check($model)) {
                    return $this->redirect('index');
                }
//                }else{
//                echo 111;exit();
//
//            }


        } else {

            var_dump($model->getErrors());
            // exit;
            //TODO
        }
        // var_dump($model);


        //显示视图
        return $this->render('login', ['model' => $model]);

    }
    public function actionGuest()
    {

        // 当前用户的身份实例。未认证用户则为 Null 。
        $identity = \Yii::$app->user->identity;

// 当前用户的ID。 未认证用户则为 Null 。
        $id = \Yii::$app->user->id;

// 判断当前用户是否是游客（未认证的）
        $isGuest = \Yii::$app->user->isGuest;

        var_dump($identity, $id, $isGuest);


    }
    public function actionLogout()
    {

        //删除保存用户那个Session
        //调用user组件的logout方法退出
        \Yii::$app->user->logout();

        $this->redirect(["login"]);

    }
    //添加用户
    public function actionAdd()
    {
        //创建一个对象
        $admin = new Admin();
        $request= new \yii\web\Request();
        if ($request->isPost){
            $data=$request->post();
            if ($admin->load($data)){
                if ($admin->validate()){
                    $admin->password=\Yii::$app->security->generatePasswordHash($admin->password);
                    $admin->add_time=time();
                    $admin->save();
                    return $this->redirect(['login']);
                }
            }
        }
        return $this->render('add',['admin'=>$admin]);
    }



}
