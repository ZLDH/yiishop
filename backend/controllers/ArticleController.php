<?php

namespace backend\controllers;



use backend\models\Article;
use backend\models\ArticleCategory;
use backend\models\ArticleDetail;
use yii\helpers\ArrayHelper;

class ArticleController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $articles = Article::find()->all();
        return $this->render('index',['articles'=>$articles]);
    }
//添加文章
    public function actionAdd()
    {
        //创建文章对象
        $article=new Article();
        //创建文章内容对象
        $articleDetail = new ArticleDetail();
        $articlecategory = ArticleCategory::find()->all();
        $options = ArrayHelper::map($articlecategory,'id','name');
        $request=\Yii::$app->request;

        if ($article->load($request->post())){
          //直接保存，文章
            $article->save();
            if ($articleDetail->load($request->post())){
                //保存文章内容ID
                $articleDetail->article_id=$article->id;
                //保存文章内容
                $articleDetail->save();
            }
            if ($article->validate()){
                //添加时间
                $article->inputtime=time();
                if ( $article->save()){
                    //跳转
                    \Yii::$app->session->setFlash("success","添加成功");
                    return  $this->redirect(['index']);
                }
            }else{
                //得到验证错误信息
                var_dump($article->getErrors());
                exit;
            }
        }
        //显示视图
        $article->status=1;

        return $this->render("add", ['article' => $article,'options'=>$options,'articleDetail'=>$articleDetail]);

    }
    //添加文章
    public function actionEdit($id)
    {
        //创建文章对象
        $article=Article::findOne($id);
        //创建文章内容对象
        $articleDetail = ArticleDetail::findOne($id);
        $articlecategory = ArticleCategory::find()->all();
        $options = ArrayHelper::map($articlecategory,'id','name');
        $request=\Yii::$app->request;

        if ($article->load($request->post())){
            //直接保存，文章
            $article->save();
            if ($articleDetail->load($request->post())){
                //保存文章内容ID
                $articleDetail->article_id=$article->id;
                //保存文章内容
                $articleDetail->save();
            }
            if ($article->validate()){
                if ( $article->save()){
                    //跳转
                    \Yii::$app->session->setFlash("success","修改成功");
                    return  $this->redirect(['index']);
                }
            }else{
                //得到验证错误信息
                var_dump($article->getErrors());
                exit;
            }
        }
        //显示视图
        $article->status=1;

        return $this->render("add", ['article' => $article,'options'=>$options,'articleDetail'=>$articleDetail]);

    }
    public function actionDel($id)
    {
        $article=Article::findOne($id);
        $articleDetail = ArticleDetail::findOne($id);
        $article->delete();
        $articleDetail->delete();
        \Yii::$app->session->setFlash("success","添加成功");
        return $this->redirect("index");

    }
}
