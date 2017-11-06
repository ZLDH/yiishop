<?=\yii\bootstrap\Html::a('添加分类',['goods-category/add'],['class'=>'btn btn-success'])?>
<?php
use yii\web;
use leandrogehlen\treegrid\TreeGrid;
echo TreeGrid::widget([
        'dataProvider' => $dataProvider,
    'keyColumnName' => 'id',
    'parentColumnName' => 'parent_id',
    'parentRootValue' => '0',
    'pluginOptions' => [
            'initialState'=>'collapsed',
    ],
    'columns' => [
            'name',
            'id',
            'parent_id',
            ['class'=>'\backend\components\TreeColumn']
    ]
]);
?>
