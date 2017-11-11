<?php
/* @var $this yii\web\View */
?>
<h1>权限列表</h1>
<?=\yii\bootstrap\Html::a('添加权限',['add'],['class'=>'btn btn-success'])?>
<table class="table">
    <tr>
        <th>权限名称</th>
        <th>权限简介</th>
        <th>操作</th>
    </tr>
<?php foreach ($permissions as $permission):?>

    <tr>
        <td><?=$permission->name?></td>
        <td><?=$permission->description?></td>
        <td>
            <?php
            echo \yii\bootstrap\Html::a("编辑",['edit','name'=>$permission->name],['class'=>'btn btn-success']);
            echo \yii\bootstrap\Html::a("删除",['del','name'=>$permission->name],['class'=>'btn btn-danger']);
            ?>

        </td>
    </tr>

    <?php endforeach;?>
</table>
