#项目介绍
"创想"全称创想电子商城，于2017年创建的全国最大的网上汽车配件交易平台，
自创立起已经与国内四十多家名优汽配生产厂家建立了战略合作关系，
从而使公司在全国二十几个省市数百家优秀客户销售中有了充足且高品质的货源保证。

<h1>商城模板</h1>
系统包括：
后台：品牌管理、商品分类管理、商品管理、订单管理、系统管理和会员管理六个功能模块。
前台：首页、商品展示、商品购买、订单管理、在线支付等。

<h1>开发环境和技术</h1>
<table>
<tr><td>开发环境</td><td>Window</td></tr>
<tr><td>开发工具</td><td>Phpstorm+PHP5.6+GIT+Apache</td></tr>
<tr><td>相关技术</td><td>Yii2.0+CDN+jQuery+sphinx</td></tr>
</table>


<h1>人员组成</h1>

<table>
<tr><td>职位</td><td>人数</td></tr>
<tr><td>项目经理和组长</td><td>1</td></tr>
<tr><td>开发人员</td><td>1</td></tr>
<tr><td>UI设计人员</td><td>0</td></tr>
<tr><td>前端开发人员</td><td>1</td></tr>
</table>


<h1>项目周期成本</h1>

<table>
<tr><td>人数</td><td>周期</td><td>负责人员</td></tr>
<tr><td>1</td><td>2周的需求与设计</td><td>项目经理</td></tr>
<tr><td>1</td><td>2周的UI设计</td><td>UI/UE</td></tr>
<tr><td>4</td><td>3个月
                  第1周需求设计
                  9周时间完成编码
                  2周时间进行测试和修复</td><td>开发人员、测试人员</td></tr>

</table>
# 系统功能模块

品牌管理：

商品分类管理：

商品管理：

商品的无限级分类

# 品牌功能模块
* 商品文章分类的增删改查
* 商品文章的增删改查
* 商品文章内容的增删改查
* 商品分类无限级分类的增删改查
* 商品的增删改查和商品内容的增删改查
* 管理员的查增删改查
## 需求
- [x] 品牌管理
- [x] 文章管理
- [x] 商品分类管理
- [x] 商品管理
- [x] 账号管理
- [ ] 权限管理
- [ ] 菜单管理
- [ ] 订单管理
#要点难点及解决方案
## 难点：
* 无限级分类的显示
* 多文件上传
* 多图片回显和修改
## 解决方案:
* 无限级分类的显示
```angular2html
echo \liyuze\ztree\ZTree::widget([
    'setting' => '{
            callback: {
		        onClick: function(event, treeId, treeNode){
		        console.dir(treeNode);
		        $("#goodscategory-parent_id").val(treeNode.id);
		        }
	     },
			data: {
				simpleData: {
					enable: true,
					idKey: "id",
			        pIdKey: "parent_id",
			        rootPId: 0
				}
			}
		}',
    'nodes' => $cates
]);
```
* 多文件上传
```
controller控制器
 $img=$request->post()['Goods']['path'];
              // var_dump($img);exit;
               foreach ($img as $v){
                   $goodsImg=new GoodsGallery();
                   $goodsImg->goods_id=$good->id;
                   $goodsImg->path=$v;
                   $goodsImg->save();
               }
view视图
<?php
    echo $form->field($good, 'logo')->widget('manks\FileInput', [
    'clientOptions' => [
    'pick' => [
    'multiple' => false,
    ],
    'server' => \yii\helpers\Url::to('upload'),
    'accept' => [
    'extensions' => 'png,jpg',
    ],
    ],
    ]);
    // 非ActiveForm
   echo '<label class="control-label">图片</label>';
echo $form->field($good, 'path')->widget('manks\FileInput', [
    'clientOptions' => [
        'pick' => [
            'multiple' => true,
        ],
         'server' => \yii\helpers\Url::to('upload'),
         'accept' => [
         	'extensions' => 'png,jpg',
         ],
    ],
]);
?>
```
* 多图片回显和修改
```
controller控制器

 $img=$request->post()['Goods']['path'];
                // var_dump($img);exit;
                if ( GoodsGallery::findOne(['goods_id'=>$id]) !== null){
                    $goodsImg->deleteall($id);
                }

                foreach ($img as $v){
                    $goodsImg=new GoodsGallery();


                    $goodsImg->path=$v;
                        $goodsImg->goods_id=$good->id;
                    $goodsImg->save();
                                   
  view视图                  
         <?php
         echo $form->field($good, 'logo')->widget('manks\FileInput', [
             'clientOptions' => [
                 'pick' => [
                     'multiple' => false,
                 ],
                 'server' => \yii\helpers\Url::to('upload'),
                 'accept' => [
                     'extensions' => 'png,jpg',
                 ],
             ],
         ]);
         // 非ActiveForm
         
         echo $form->field($good, 'path')->widget('manks\FileInput', [
             'clientOptions' => [
                 'pick' => [
                     'multiple' => true,
                 ],
                 'server' => \yii\helpers\Url::to('upload'),
                 'accept' => [
                     'extensions' => 'png,jpg',
                 ],
             ],
         ]);
         
         echo $form->field($good, 'imgFile')->widget('manks\FileInput', [
             'clientOptions' => [
                 'pick' => [
                     'multiple' => true,
                 ],
                 'server' => \yii\helpers\Url::to('upload'),
                 'accept' => [
                     'extensions' => 'png,jpg',
                 ],
             ],
         ]);
         ?>           
```