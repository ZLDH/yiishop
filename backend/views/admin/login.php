<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = 'Login';
//$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .row{
        text-align:center
    }
    .col-lg-5{
        align=center
    }
</style>
<div class="site-login" >
    <div class="alert alert-info">
     请填写您的用户名和密码
 </div>

    <div class="col-md-3"></div>
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
            <fieldset>
                <div class="input-group input-group-lg">
                     <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
                          <?php echo Html::input('type','LoginForm[username]', $model->username, ['class'=>'form-control','placeholder'=>'Username']); ?>
                </div>
                <div class="clearfix"></div><br>
                <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
                       <?php echo Html::input('password','LoginForm[password]', $model->password, ['class'=>'form-control','placeholder'=>'Password']); ?>
                </div>

            <?= $form->field($model, 'rememberMe')->checkbox()->label("是否记住密码") ?>

            <div class="clearfix">
                <?= Html::submitButton('登录', ['class' => 'btn btn-primary btn-lg btn-block']) ?>
            </div>
            </fieldset>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>







