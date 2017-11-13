<h1>商品列表</h1>
<?=\yii\bootstrap\Html::a('添加商品',['goods/add'],['class'=>'btn btn-success'])?>
<?=\yii\bootstrap\Html::a('回收站',['goods/rec'],['class'=>'btn btn-default'])?>
<div class="col-md-10">
    <?php
    $searchForm=new \backend\models\GoodsSearchFrom();
    $form=\yii\bootstrap\ActiveForm::begin([

        'method' => 'get',
        'action'=>['index'],
        'options' => ['class'=>"form-inline pull-left"]
    ]);
    echo $form->field($searchForm,'minPrice')->label(false)->textInput(['size'=>5,'placeholder'=>"最低价"]);
    echo "-";
    echo $form->field($searchForm,'maxPrice')->label(false)->textInput(['size'=>5,'placeholder'=>"最高价"]);
    echo " ";
    echo $form->field($searchForm,'keyword')->label(false)->textInput(['placeholder'=>"请输入关键字或货号"]);
    echo " ";
    echo \yii\bootstrap\Html::submitButton("搜索",['class'=>'btn btn-success','style'=>"margin-bottom:8px"]);
    \yii\bootstrap\ActiveForm::end();
    ?>

</div>
<table class="table">
    <tr>
        <th>Id</th>
        <th>名称</th>
        <th>货号</th>
        <th>商品图片</th>
        <th>商品分类</th>
        <th>品牌</th>
        <th>市场价格</th>
        <th>本店价格</th>
        <th>库存</th>
        <th>是否上架</th>
        <th>状态</th>
        <th>排序</th>
        <th>录入时间</th>
        <th>操作</th>
    </tr>
    <?php foreach ($goods as $good):?>
        <tr>
        <?php if ($good->status==1){?>
            <td><?=$good->id?></td>
            <td><?=$good->name?></td>
            <td><?=$good->sn?></td>
            <td><?=\yii\bootstrap\Html::img($good->logo,['height'=>50])?></td>
            <td><?=$good->category->name?></td>
            <td><?=$good->brand->name?></td>
            <td><?=$good->marke_price?></td>
            <td><?=$good->shop_price?></td>
            <td><?=$good->stock?></td>
            <td><?=\backend\models\Goods::$saleText[$good->is_on_sale]?></td>
            <td><?=\backend\models\Goods::$statusText[$good->status]?></td>
            <td><?=$good->sort?></td>
            <td><?=date('Y-m-d H:i:s',$good->inputtime)?></td>
            <td>
                <?php
                echo \yii\bootstrap\Html::a("编辑",['goods/edit','id'=>$good->id],['class'=>'btn btn-success']);
                echo \yii\bootstrap\Html::a("删除",['goods/del','id'=>$good->id],['class'=>'btn btn-danger']);
                echo \yii\bootstrap\Html::a("查看",['goods-intro/index','id'=>$good->id],['class'=>'btn btn-info']);
                ?>
            </td>
            </tr>
        <?php }?>
    <?php endforeach;?>

</table>
<?php
echo \yii\widgets\LinkPager::widget([

    'pagination' => $page
]);
?>

