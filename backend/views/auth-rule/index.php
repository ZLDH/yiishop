<?php
/* @var $this yii\web\View */
?>
<h1>角色列表</h1>
<?=\yii\bootstrap\Html::a('添加角色',['add'],['class'=>'btn btn-success'])?>
<table class="table">
    <tr>
        <th>角色名称</th>
        <th>角色描述</th>
        <th>权限</th>
        <th>操作</th>
    </tr>
    <?php foreach ($roles as $role):?>

        <tr>
            <td>
                <?=$role->name?>
            </td>
            <td>

                <?=$role->description?>
            </td>
            <td>
                <?php
                $auth=Yii::$app->authManager;
                //得到当前角色所有权限
                $pers= $auth->getPermissionsByRole($role->name);
                // var_dump($pers);
                foreach ($pers as $per){
                    echo $per->description."||";
                    
                }
                ?>
            </td>
            <td>
                <?php
                echo  \yii\bootstrap\Html::a("编辑",['edit','name'=>$role->name],['class'=>'btn btn-success']);
                echo  \yii\bootstrap\Html::a("删除",['del','name'=>$role->name],['class'=>'btn btn-danger']);
                ?>
            </td>
        </tr>


    <?php endforeach;?>

</table>