<?=\yii\bootstrap\Html::a('添加分类',['goods-category/add'],['class'=>'btn btn-success'])?>
<table class="table">
    <th>id</th>
    <th>名称</th>
    <th>简介</th>
    <th>操作</th>
    <?php foreach($models as $model){?>
        <tr>
            <td><?php echo $model->id?></td>
            <!--str_repeat('字符串','重复的次数');重复一个字符串-->
            <td><?php echo str_repeat('--|',$model->depth);?><?php echo $model['name']?></td>
            <td><?php echo $model->intro?></td>
        <td><?php echo \yii\bootstrap\Html::a("编辑",['goods-category/edit','id'=>$model->id],['class'=>'btn btn-success']); ?>
            <?php echo \yii\bootstrap\Html::a("删除",['goods-category/del','id'=>$model->id],['class'=>'btn btn-danger']); ?>
        </td>
        </tr>
    <?php }?>
</table>
