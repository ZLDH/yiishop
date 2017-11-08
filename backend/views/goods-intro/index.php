<?=\yii\bootstrap\Html::a('返回',['goods/index'],['class'=>'btn btn-default'])?>
<style>
    #wz{text-align:center}
</style>
<table>
    <h3>
        <div id="wz">
            商品内容
        </div>
    </h3>
    <tr>
        <td><?=$goodIntro->content?></td>
<br/>
    </tr>
</table>
<table>
    <h3>
        <div id="wz">
            商品图片
        </div>
    </h3>
    <tr>
<td><?php foreach ($goodsImgs as $goodsImg):?>
                <?php  if ($goodsImg->goods_id===$id){
         echo   \yii\bootstrap\Html::img($goodsImg->path,['height'=>200]);
        }
       ?>
<?php endforeach;?>
        </td>

    </tr>
</table>