<h1>商品列表</h1>
<?=\yii\bootstrap\Html::a('添加管理员',['admin/add'],['class'=>'btn btn-success'])?>

<table class="table">
    <tr>
        <th>Id</th>
        <th>用户名</th>
        <th>邮箱</th>
        <th>自动登录令牌</th>
        <th>令牌创建时间</th>
        <th>注册时间</th>
        <th>最后登录时间</th>
        <th>最后登录IP</th>
        <th>操作</th>
    </tr>
    <?php foreach ($admins as $admin):?>
        <tr>
            <td><?=$admin->id?></td>
            <td><?=$admin->username?></td>
            <td><?=$admin->email?></td>
            <td><?=$admin->token?></td>
            <td><?=date('Y-m-d H:i:s',$admin->token_create_time)?></td>
            <td><?=date('Y-m-d H:i:s',$admin->add_time)?></td>
            <td><?=date('Y-m-d H:i:s',$admin->last_login_time)?></td>
            <td><?=$admin->last_login_ip?></td>
            <td>
                <?php
                echo \yii\bootstrap\Html::a("编辑",['admin/edit','id'=>$admin->id],['class'=>'btn btn-success']);
                echo \yii\bootstrap\Html::a("删除",['admin/del','id'=>$admin->id],['class'=>'btn btn-danger']);
                ?>
            </td>
            </tr>
    <?php endforeach;?>

</table>
<?php
//echo \yii\widgets\LinkPager::widget([
//
//    'pagination' => $page
//]);
?>

