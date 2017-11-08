<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Member */
/* @var $form ActiveForm */
?>
<div class="member-login">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username') ?>
    <?= $form->field($model, 'password')->passwordInput() ?>

    <div class="form-group">
        <?= Html::submitButton('登录', ['class' => 'btn btn-primary']) ?>
        <?=\yii\bootstrap\Html::a('注册',['admin/add'],['class'=>'btn btn-default'])?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- member-login -->

