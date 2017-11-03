<?=\yii\bootstrap\Html::a('返回首页',['brand/index'],['class'=>'btn btn-primary'])?>
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
            <?php if ($brand->status==0){?>
            <td><?=$brand->id?></td>
            <td><?=$brand->name?></td>
            <td><?=\yii\bootstrap\Html::img("@web/".$brand->logo,['height'=>50])?></td>
            <td><?=$brand->sort?></td>
            <td><?=\backend\models\Brand::$statusText[$brand->status]?></td>
            <td>
                <?php
                echo \yii\bootstrap\Html::a("编辑",['brand/edit','id'=>$brand->id],['class'=>'btn btn-success']);
                echo \yii\bootstrap\Html::a("删除",['brand/del','id'=>$brand->id],['class'=>'btn btn-danger']);
//                echo \yii\bootstrap\Html::a("还原",['brand/ret','id'=>$brand->id],['class'=>'btn btn-danger']);?>
            </td>
        </tr>
    <?php }?>
    <?php endforeach;?>

</table>


