<?php

namespace backend\controllers;

use backend\models\Brand;
use backend\models\Goods;
use backend\models\GoodsCategory;
use backend\models\GoodsDayCount;
use backend\models\GoodsGallery;
use backend\models\GoodsIntro;
use backend\models\GoodsSearchFrom;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use flyok666\qiniu\Qiniu;
use yii\helpers\Json;
use yii\web\Request;

class GoodsController extends \yii\web\Controller
{
    public function actionIndex()
    {
        //构造查询对象
        $query = Goods::find();
        $request=\Yii::$app->request;
//         var_dump($request->get());exit;
        $data=$request->get('GoodsSearchFrom');
//        var_dump($data);exit;
        //接收变量
        $keyword=$data['keyword'];
        $minPrice=$data['minPrice'];
        $maxPrice=$data['maxPrice'];
//        $status=$data['status'];
        if ($minPrice>0){
            //拼接条件
            $query->andWhere("shop_price >= {$minPrice}");
        }
        if ($maxPrice>0){
            $query->andWhere("shop_price <= {$maxPrice}");
        }
        if (isset($keyword)){
            $query->andWhere("name like '%{$keyword}%' or sn like '%{$keyword}%'");
        }
        //判断0和1的情况必需用三等号
//        if ($status ==="1" or $status==="0"){
//            $query->andWhere("status= {$status}");
//        }
        $count=$query->count();
        $searchForm=new GoodsSearchFrom();
        $page = new Pagination(
            [
                'pageSize'=>5,
                'totalCount'=>$count
            ]
        );
        $goods=$query->limit($page->limit)->offset($page->offset)->all();
        return $this->render('index',compact("page","goods","searchForm"));
    }

    public function actionRec()
    {
        //处理数据
        $goods = Goods::find()->all();
        //1.总条数
        $count = Goods::find()->count();

        //2.每页显示条数
        $pageSize = 4;

        //创建分页对象
        $page = new Pagination(
            [
                'pageSize' => $pageSize,
                'totalCount' => $count
            ]
        );
        $goods = Goods::find()->limit($page->limit)->offset($page->offset)->all();
        return $this->render('rec',['goods'=>$goods,'page'=>$page]);
    }

//添加商品
    public function actionAdd()
    {
        //创建商品对象
        $good=new Goods();
        //创建商品内容对象
        $goodIntro = new GoodsIntro();
        $goodGallery = new GoodsGallery();
        $goodcategory = GoodsCategory::find()->all();
        $brand = Brand::find()->all();
        $options = ArrayHelper::map($goodcategory,'id','nametext');
        $label = ArrayHelper::map($brand,'id','name');
        $re = new Request();
        $request=\Yii::$app->request;

        if ($good->load($request->post())){
            //直接保存，商品
            $good->save();
            if ($goodIntro->load($request->post())){
                //保存商品内容ID
                $goodIntro->goods_id=$good->id;
//                $goodGallery->goods_id=$good->id;
                //保存商品内容
                $goodIntro->save();
            }
            if ($good->validate()){
                //添加时间
                $good->inputtime=time();
                //拼一个当天日期
                $time=date('Ymd',time());
                //然后通过当天日期去数量表查询
                $aa=GoodsDayCount::find()->where(['day'=>$time])->one();
                //定义一个货号的变量
                $sn='';
                //如果为空 说明当天没有添加商品  这样货号可以写死  也可以把数量表添加当天的数据
                if(empty($aa)){
                    $sn=$time.'00001';
                    $goodsDayCount=new GoodsDayCount();
                    $goodsDayCount->day=$time;
                    $goodsDayCount->count=1;
                    $goodsDayCount->save();
                }else{
                    $count=$aa->count;
                    $sn=$time.substr('0000'.($count+1),-5);
                    $aa->count=$count+1;
                    $aa->save();
                }
                $good ->sn=$sn;
                 $good->save();
                //获取多文件上传的数据
               $img=$request->post()['Goods']['path'];
              // var_dump($img);exit;
               foreach ($img as $v){
                   $goodsImg=new GoodsGallery();
                   $goodsImg->goods_id=$good->id;
                   $goodsImg->path=$v;
                   $goodsImg->save();
               }
                return  $this->redirect(['index']);
            }else{
                //得到验证错误信息
                var_dump($good->getErrors());
                exit;
            }
        }
        //显示视图
        $good->status=1;
        $good->is_on_sale=1;

        return $this->render("add", ['good' => $good,'options'=>$options,'label'=>$label,'goodIntro'=>$goodIntro,'goodGallery'=>'$goodGallery']);

    }

    //修改商品
    public function actionEdit($id)
    {
        //创建商品对象
        $good=Goods::findOne($id);
        //创建商品内容对象
        //        var_dump(GoodsIntro::findOne(['goods_id'=>$id]));exit;
        if ( GoodsIntro::findOne(['goods_id'=>$id]) == null){
            $goodIntro = new GoodsIntro();
        }else{
            $goodIntro = GoodsIntro::findOne(['goods_id'=>$id]);
        }
        $goodsImg = GoodsGallery::findOne(['goods_id'=>$id]);
        $goodcategory = GoodsCategory::find()->all();
        $brand = Brand::find()->all();
        $options = ArrayHelper::map($goodcategory,'id','nametext');
        $label = ArrayHelper::map($brand,'id','name');
        $request=\Yii::$app->request;

        if ($good->load($request->post())){
            //直接保存，商品
            $good->save();
            if ($goodIntro->load($request->post())){
                //保存商品内容ID
                $goodIntro->goods_id=$good->id;
                //保存商品内容
                $goodIntro->save();
            }
            if ($good->validate()){
                //添加时间
                $good->inputtime=time();
                //拼一个当天日期
                $time=date('Ymd',time());
                //然后通过当天日期去数量表查询
                $aa=GoodsDayCount::find()->where(['day'=>$time])->one();
                //定义一个货号的变量
                $sn='';
                //如果为空 说明当天没有添加商品  这样货号可以写死  也可以把数量表添加当天的数据
                if(empty($aa)){
                    $sn=$time.'00001';
                    $goodsDayCount=new GoodsDayCount();
                    $goodsDayCount->day=$time;
                    $goodsDayCount->count=1;
                    $goodsDayCount->save();
                }else{
                    $count=$aa->count;
                    $sn=$time.substr('0000'.($count+1),-5);
                    $aa->count=$count+1;
                    $aa->save();
                }
                $good ->sn=$sn;
                $good->save();
                //获取多文件上传的数据
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
                }
                return  $this->redirect(['index']);
            }else{
                //得到验证错误信息
                var_dump($good->getErrors());
                exit;
            }
        }
        //显示视图
        $good->status=1;
        $good->is_on_sale=1;
        $goodsGallerys=GoodsGallery::find()->where(['goods_id'=>$id])->all();
        foreach ($goodsGallerys as $v){
            $good->imgFile[]=$v->path;
        }
        return $this->render("edit", ['good' => $good,'options'=>$options,'label'=>$label,'goodIntro'=>$goodIntro,'goodsImg'=>'$goodsImg']);

    }
    //删除
    public function actionDel($id)
    {
        $good=Goods::findOne($id);
        $goodIntro = GoodsIntro::findOne(['goods_id'=>$id]);
        $goodsImg = GoodsGallery::findAll(['goods_id'=>$id]);
        $good->delete();
        $goodIntro->delete();
        $goodsImg->delete(['goods_id'=>$id]);
        \Yii::$app->session->setFlash("success","删除成功");
        return $this->redirect("index");

    }
    public function actionUpload()
    {
//        var_dump($_FILES['file']['tmp_name']);exit;
        //七牛云上传
        $config = [
            'accessKey'=>'nmSpj8VcRsTSErIhMUVn6nyuW5QjUZ0IRF9GMKBA',
            'secretKey'=>'Qr8FgRMGPw4_cpo8Od1KGCbfx0lYds69OrQQbGIe',
            'domain'=>'http://oyvgmuh04.bkt.clouddn.com/',
            'bucket'=>'yiishop',
            'area'=>Qiniu::AREA_HUANAN
        ];
        //实例化对象
        $qiniu = new Qiniu($config);
        $key = time();
        //调用上传方法
        $qiniu->uploadFile($_FILES['file']['tmp_name'],$key);
        $url = $qiniu->getLink($key);
//        exit($url);
        $info=[
            'code'=>0,
            'url'=>$url,
            'attachment'=>$url
        ];
        exit(Json::encode($info));
    }

    public function actionDelqi()
    {
        $qiNiu = new Qiniu(
            $config = [
                'accessKey'=>'nmSpj8VcRsTSErIhMUVn6nyuW5QjUZ0IRF9GMKBA',
                'secretKey'=>'Qr8FgRMGPw4_cpo8Od1KGCbfx0lYds69OrQQbGIe',
                'domain'=>'http://oyvgmuh04.bkt.clouddn.com/',
                'bucket'=>'yiishop',
                'area'=>Qiniu::AREA_HUANAN
            ]
        );
        $qiNiu->delete("1509770606","yiishop");
    }



}
