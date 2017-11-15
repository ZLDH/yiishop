<?php

namespace backend\controllers;

use backend\models\Admin;
use common\models\LoginForm;
use yii\helpers\ArrayHelper;
use yii\web\Request;

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
        $model=new \backend\models\LoginForm();
        //判断是不是Post
        $request=\Yii::$app->request;
        if ($request->isPost){
            //数据绑定
            $model->load($request->post());
            if ($model->validate()){
                //根据用户名把用户对象查出来
                $admin=Admin::findOne(['username'=>$model->username]);
                if ($admin){
                    //存在 判断密码
                    if (\Yii::$app->security->validatePassword($model->password,$admin->password)){
                        //执行登录
                        \Yii::$app->user->login($admin,$model->rememberMe?3600*24*7:0);
                        //跳转
                        $admina=\Yii::$app->request->userIP;
                        $admin->last_login_ip=$admina;
                        $admin->last_login_time=time();
                        $admin->save();
                        return $this->redirect(['home']);

                    }else{
                        //密码错误
                        $model->addError("password","密码错误");
                    }
                }else{
                    //不存在 提示没用用户名
                    $model->addError("username","用户名不存在");
                }
            }
        }
        //显示视图
        return $this->render("login", ['model' => $model]);

    }

//退出
    public function actionLogout(){
        \Yii::$app->user->logout();
        return $this->redirect(['login']);
    }
    //添加用户
    public function actionAdd()
    {
        //创建管理员
        $admin=new Admin();
        $request = new Request();
        $auth = \Yii::$app->authManager;
        $role=$auth->getRoles();
        $roles=ArrayHelper::map($role,'name','description');
        if ($request->isPost){
            $data = $request->post();
            if ($admin->load($data)){
                //加密
                $admin->password=\Yii::$app->security->generatePasswordHash($admin->password);
                //随机字符串
                $admin->token=\Yii::$app->security->generateRandomString();
                $admin->token_create_time=time();
                $admin->add_time=time();
                 $admin->save();
                 if ($data['Admin']['roles']){
                     foreach ($data['Admin']['roles'] as $role){
                         //找到角色
                         $role=$auth->getRole($role);
                         //把当前用户追加到角色中
                         $auth->assign($role,$admin->id);
                     }
                 }
                \Yii::$app->session->setFlash("success",'注册成功');
                return $this->redirect(['index']);
        }
        }
        return $this->render('add', ['admin' => $admin,'roles'=>$roles]);
    }
    //修改用户
    public function actionEdit($id)
    {
        //创建管理员
        $admin=Admin::findOne($id);
        $request = new Request();
        if ($request->isPost){
            $data = $request->post();
            if ($admin->load($data)){
                //加密
                $admin->password=\Yii::$app->security->generatePasswordHash($admin->password);
                //随机字符串
                $admin->token=\Yii::$app->security->generateRandomString();
                $admin->token_create_time=time();
                $admin->add_time=time();
                $admin->save();
                \Yii::$app->session->setFlash("success",'修改成功');
                return $this->redirect(['index']);
            }
        }
        return $this->render('edit', ['admin' => $admin]);
    }
    //删除管理员
    public function actionDel ($id){
        $admin = Admin::findOne($id);
        $admin->delete();
        return $this->redirect(['index']);
    }
    public function actionHome(){
        return $this->render('home');
    }
}
