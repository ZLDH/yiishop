<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<?php $form = ActiveForm::begin(); ?>

<?= $form->field($admin,'username')->textInput()->label("用户名") ?>
<?= $form->field($admin,'password')->textInput()->label("密码") ?>
<?= $form->field($admin,'salt')->textInput()->label("盐") ?>
<?= $form->field($admin,'email')->textInput()->label("邮箱") ?>
<?= $form->field($admin,'token')->textInput()->label("自动登录令牌") ?>
<?= $form->field($admin,'token_create_time')->textInput()->label("令牌注册时间") ?>
<?= $form->field($admin,'last_login_time')->textInput()->label("最后登录时间") ?>
<?= $form->field($admin,'last_login_ip')->textInput()->label("最后登录IP") ?>
    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>
<?php ActiveForm::end(); ?>