
use leandrogehlen\treegrid\TreeGrid;

<?=\leandrogehlen\treegrid\TreeGrid::widget([
    'dataProvider' => $dataProvider,
    'keyColumnName' => 'id',
    'parentColumnName' => 'parent_id',
    'columns' => [
        'id',
        'description',
        ['class' => 'yii\grid\ActionColumn']
    ]
]); ?>