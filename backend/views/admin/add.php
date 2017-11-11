<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<h2>用户添加</h2>
<br>
<?php $form = ActiveForm::begin(); ?>

<?= $form->field($admin,'username')->textInput()->label("用户名") ?>
<?= $form->field($admin,'password')->textInput()->label("密码") ?>
<?= $form->field($admin,'email')->textInput()->label("邮箱") ?>
    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>
<?php ActiveForm::end(); ?>