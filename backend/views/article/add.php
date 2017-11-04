<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<?php $form = ActiveForm::begin(); ?>

<?= $form->field($article,'name')->textInput()->label("名称") ?>
<?= $form->field($article, 'article_category_id')->dropDownList($options) ?>
<?= $form->field($article,'sort')->textInput()->label("排序") ?>
<?= $form->field($article, 'status')->inline()->radioList(backend\models\Article::$statusText) ?>
<?= $form->field($article, 'intro')->textarea()->label("简介") ?>
<?= $form->field($articleDetail,'content')->textarea()->label("文章内容") ?>
    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>
<?php ActiveForm::end(); ?>