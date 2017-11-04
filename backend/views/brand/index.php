<?=\yii\bootstrap\Html::a('添加品牌',['brand/add'],['class'=>'btn btn-success'])?>
<?=\yii\bootstrap\Html::a('回收站',['brand/rec'],['class'=>'btn btn-default'])?>
<table class="table">
    <tr>
        <th>Id</th>
        <th>名称</th>
        <th>图片</th>
        <th>排序</th>
        <th>状态</th>
        <th>操作</th>
    </tr>
    <?php foreach ($brands as $brand):?>
        <tr>
            <?php if ($brand->status==1){?>
            <td><?=$brand->id?></td>
            <td><?=$brand->name?></td>
            <td><?=\yii\bootstrap\Html::img($brand->image,['height'=>50])?></td>
            <td><?=$brand->sort?></td>
            <td><?=\backend\models\Brand::$statusText[$brand->status]?></td>
            <td>
                <?php
                echo \yii\bootstrap\Html::a("编辑",['brand/edit','id'=>$brand->id],['class'=>'btn btn-success']);
                echo \yii\bootstrap\Html::a("删除",['brand/del','id'=>$brand->id],['class'=>'btn btn-danger']);
//                echo \yii\bootstrap\Html::a("回收",['brand/rec','id'=>$brand->id],['class'=>'btn btn-danger']);?>
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

