<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\web\JsExpression;
use xj\uploadify\Uploadify;
?>
    <h2>添加品牌</h2>
<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model,'name')->textInput()->label("名称") ?>
<?= $form->field($model,'sort')->textInput()->label("排序") ?>
<?= $form->field($model, 'status')->inline()->radioList(backend\models\Brand::$statusText) ?>
<?= $form->field($model,'logo')->widget('manks\FileInput', []);?>
<?= $form->field($model, 'intro')->textarea()->label("简介") ?>
    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>
<?php ActiveForm::end(); ?>