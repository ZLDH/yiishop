<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/11 0011
 * Time: 下午 2:08
 */
$from = \yii\bootstrap\ActiveForm::begin();
echo $from->field($model,'name');
echo $from->field($model,'description')->textarea();
echo \yii\bootstrap\Html::submitButton('提交');
\yii\bootstrap\ActiveForm::end();
