<?=\yii\bootstrap\Html::a('添加分类',['articlecategory/add'],['class'=>'btn btn-success'])?>
<table class="table">
    <h1>分类管理</h1>
    <tr>
        <th>Id</th>
        <th>名称</th>
        <th>简介</th>
        <th>排序</th>
        <th>状态</th>
        <th>是否帮助</th>
        <th>操作</th>
    </tr>
    <?php foreach ($articlecategorys as $articlecategory):?>
        <tr>
            <td><?=$articlecategory->id?></td>
            <td><?=$articlecategory->name?></td>
            <td><?=$articlecategory->intro?></td>
            <td><?=$articlecategory->sort?></td>
            <td><?=\backend\models\ArticleCategory::$statusText[$articlecategory->status]?></td>
            <td><?=\backend\models\ArticleCategory::$is_helpHelp[$articlecategory->is_help]?></td>
            <td>
                <?php
                echo \yii\bootstrap\Html::a("编辑",['articlecategory/edit','id'=>$articlecategory->id],['class'=>'btn btn-success']);
                echo \yii\bootstrap\Html::a("删除",['articlecategory/del','id'=>$articlecategory->id],['class'=>'btn btn-danger']);
?>
            </td>
            </tr>
    <?php endforeach;?>

</table>


