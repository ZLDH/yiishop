<?=\yii\bootstrap\Html::a('添加文章',['article/add'],['class'=>'btn btn-success'])?>
<table class="table">
    <h1>文章管理</h1>
    <tr>
        <th>Id</th>
        <th>名称</th>
        <th>分类</th>
        <th>状态</th>
        <th>排序</th>
        <th>添加时间</th>
        <th>操作</th>
    </tr>
    <?php foreach ($articles as $article):?>
        <tr>
            <td><?=$article->id?></td>
            <td><?=$article->name?></td>
            <td><?=$article->articleCategory->name?></td>
            <td><?=\backend\models\Article::$statusText[$article->status]?></td>
            <td><?=$article->sort?></td>
            <td><?=date('Y-m-d H:i:s',$article->inputtime)?></td>
            <td>
                <?php
                echo \yii\bootstrap\Html::a("编辑",['article/edit','id'=>$article->id],['class'=>'btn btn-success']);
                echo \yii\bootstrap\Html::a("删除",['article/del','id'=>$article->id],['class'=>'btn btn-danger']);
                echo \yii\bootstrap\Html::a("查看",['article-detail/index','id'=>$article->id],['class'=>'btn btn-info']);
                ?>
            </td>
        </tr>
    <?php endforeach;?>

</table>



