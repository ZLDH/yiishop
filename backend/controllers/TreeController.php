<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/5 0005
 * Time: 上午 11:55
 */

namespace backend\controllers;


use backend\models\Tree;
use yii\web\Controller;
use Yii;
use yii\data\ActiveDataProvider;


class TreeController extends Controller
{

    /**
     * Lists all Tree models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = Tree::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

}