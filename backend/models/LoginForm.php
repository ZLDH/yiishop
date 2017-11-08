<?php
/**
 * Created by PhpStorm.
 * Email: wenmang2015@qq.com
 * Date: 2017/11/1
 * Time: 9:16
 * Company: 源码时代重庆校区
 */

namespace frontend\models;


use yii\base\Model;

class LoginForm extends Model
{
    public $username;
    public $password;

    public function rules()
    {
        return [
            [['username','password'],'required'],

        ];
    }

    public function attributeLabels()
    {
        return [
            'username'=>'账号',
            'password'=>'密码',


        ];

    }
}