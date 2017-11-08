<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<?php $form = ActiveForm::begin(); ?>

<?= $form->field($daycount,'day')->textInput()->label("日期") ?>
<?= $form->field($daycount,'count')->textInput()->label("商品数量") ?>
    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>
<?php ActiveForm::end(); ?>