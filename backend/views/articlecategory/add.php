<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($articlecategory,'name')->textInput()->label("名称") ?>
<?= $form->field($articlecategory,'sort')->textInput()->label("排序") ?>
<?= $form->field($articlecategory, 'status')->inline()->radioList(backend\models\Articlecategory::$statusText) ?>
<?= $form->field($articlecategory, 'is_help')->inline()->radioList(backend\models\ArticleCategory::$is_helpHelp) ?>
<?= $form->field($articlecategory, 'intro') ?>
    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>
<?php ActiveForm::end(); ?>