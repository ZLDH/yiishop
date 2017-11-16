<?php

namespace frontend\controllers;

class UserController extends \yii\web\Controller
{
    public $layout = "login";
    public function actionReg()
    {
        return $this->render('reg');
    }

}
