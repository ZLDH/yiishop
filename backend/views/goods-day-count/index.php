<table class="table">
    <h1>文章管理</h1>
    <tr>
        <th>日期</th>
        <th>商品数量</th>
        <th>操作</th>
    </tr>
    <?php foreach ($daycounts as $daycount):?>
        <tr>
            <td><?=$daycount->day?></td>
            <td><?=$daycount->count?></td>
            <td>
                <?php
                echo \yii\bootstrap\Html::a("编辑",['goods-day-count/edit','id'=>$daycount->day],['class'=>'btn btn-success']);
                ?>
            </td>
        </tr>
    <?php endforeach;?>

</table>



