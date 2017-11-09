<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/9 0009
 * Time: 上午 10:56
 */

namespace backend\controllers;


use yii\web\Controller;

class TestController extends Controller
{
    public function actionIndex(){
        return $this->render('index');
    }
    public function actionTest()
    {
        $str1="abcdefghijkmnopqrstuvwxyz";
        $str2=rand(100000,999999);
        echo md5($str1.'123456'.time());
        echo "<br>";
        $str2=rand(100000,999999);
        echo md5($str1.'123456'.$str2);
    }

}