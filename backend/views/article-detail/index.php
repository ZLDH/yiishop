<?=\yii\bootstrap\Html::a('返回',['article/index'],['class'=>'btn btn-default'])?>


<style>
    #wz{text-align:center}
</style>
<table>
    <h3>
        <div id="wz">
            文章内容
        </div>
    </h3>
        <tr>
            <td><?=$articledetails->content?></td>
            </tr>


</table>



