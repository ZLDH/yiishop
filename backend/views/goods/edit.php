<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\web\JsExpression;
use xj\uploadify\Uploadify;
use yii\redactor\widgets\Redactor;

?>
<?php $form = ActiveForm::begin(); ?>
<?= $form->field($good,'name')->textInput()->label("名称") ?>
<?= $form->field($good,'sn')->hiddenInput()->label("货号") ?>
<?php
echo $form->field($good, 'logo')->widget('manks\FileInput', [
    'clientOptions' => [
        'pick' => [
            'multiple' => false,
        ],
        'server' => \yii\helpers\Url::to('upload'),
        'accept' => [
            'extensions' => 'png,jpg',
        ],
    ],
]);
// 非ActiveForm

echo $form->field($good, 'path')->widget('manks\FileInput', [
    'clientOptions' => [
        'pick' => [
            'multiple' => true,
        ],
        'server' => \yii\helpers\Url::to('upload'),
        'accept' => [
            'extensions' => 'png,jpg',
        ],
    ],
]);

echo $form->field($good, 'imgFile')->widget('manks\FileInput', [
    'clientOptions' => [
        'pick' => [
            'multiple' => true,
        ],
        'server' => \yii\helpers\Url::to('upload'),
        'accept' => [
            'extensions' => 'png,jpg',
        ],
    ],
]);
?>
<?= $form->field($good, 'goods_category_id')->dropDownList($options)->label("商品分类") ?>
<?= $form->field($good, 'brand_id')->dropDownList($label)->label("品牌") ?>
<?= $form->field($good,'marke_price')->textInput()->label("市场价格") ?>
<?= $form->field($good,'shop_price')->textInput()->label("本店价格") ?>
<?= $form->field($good,'stock')->textInput()->label("库存") ?>
<?= $form->field($good, 'is_on_sale')->inline()->radioList(backend\models\Goods::$saleText)->label("是否上架") ?>
<?= $form->field($good, 'status')->inline()->radioList(backend\models\Goods::$statusText)->label("状态") ?>
<?= $form->field($good,'sort')->textInput()->label("排序") ?>
<?= $form->field($goodIntro, 'content')->widget(\yii\redactor\widgets\Redactor::className())->label("文章内容") ?>
    <div class="form-group">
        <?= Html::submitButton('提交', ['class' => 'btn btn-primary']) ?>
    </div>
<?php ActiveForm::end(); ?>