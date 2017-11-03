<?php
namespace backend\controllers;
use backend\models\Brand;
use yii\web\UploadedFile;
use yii\data\Pagination;
class BrandController extends \yii\web\Controller
{
    /**
     * 品牌列表
     * @return string
     */
    public function actionIndex()
    {
        //处理数据
        $brands=Brand::find()->all();
        //1.总条数
        $count = Brand::find()->count();

        //2.每页显示条数
        $pageSize = 2;

        //创建分页对象
        $page = new Pagination(
            [
                'pageSize' => $pageSize,
                'totalCount' => $count
            ]
        );
        $brands = Brand::find()->limit($page->limit)->offset($page->offset)->all();
        return $this->render('index',['brands'=>$brands,'page'=>$page]);

    }
    //添加
    public function actionAdd()
    {
        //创建对象
        $model=new Brand();
        $request=\Yii::$app->request;
        if ($model->load($request->post())){
            //创建文件上传对象
            $model->imgFile=UploadedFile::getInstance($model,'imgFile');
            //拼装路径
            $imgFilePath="images/brand/".uniqid().".".$model->imgFile->extension;
            //保存图片
            $model->imgFile->saveAs($imgFilePath,false);
            if ($model->validate()){
                //和数据库里logo字段绑定
                $model->logo=$imgFilePath;
                //保存数据
                if ( $model->save()){
                    //跳转
                    return  $this->redirect(['index']);
                }
            }
        }
        //显示视图
        $model->status=1;
        return $this->render("add", ['model' => $model]);
    }
    //修改
    public function actionEdit($id)
    {
        //创建对象
//        $model=new Brand();
        $model = Brand::findOne($id);
        $request=\Yii::$app->request;
        if ($model->load($request->post())){
            //创建文件上传对象
            $model->imgFile=UploadedFile::getInstance($model,'imgFile');


            if ($model->validate()){
                if ($model->imgFile){
                    //拼装路径
                    $imgFilePath="images/brand/".uniqid().".".$model->imgFile->extension;
                    //保存图片
                    $model->imgFile->saveAs($imgFilePath,false);

                //和数据库里logo字段绑定
                $model->logo=$imgFilePath;
                }
                //保存数据
                if ( $model->save()){
                    //跳转
                    return  $this->redirect(['index']);
                    }

            }
        }
        //显示视图
        $model->status=1;
        return $this->render("add", ['model' => $model]);
    }
    //删除
    public function actionDel($id)
    {
        $brand = Brand::findOne($id);
        $brand->delete();
        $this->redirect(["brand/index"]);
    }
    //回收
    public function actionRec()
    {
        //处理数据
        $brands=Brand::find()->all();
        return $this->render('rec',['brands'=>$brands]);

    }
}