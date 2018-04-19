<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \mdm\admin\models\form\Signup */

$this->title = Yii::t('rbac-admin', 'Nuevo usuario');
$this->params['breadcrumbs'][] = $this->title;
?>



<div class="login-box">
    <!-- /.login-logo -->
    <div class="login-box-body">

        <?php $form = ActiveForm::begin(['id' => 'form-signup', 'enableClientValidation' => false]); ?>

        <?= $form->field($model, 'username')->label('Usuario') ?>
        <?= $form->field($model, 'email') ?>
        <?= $form->field($model, 'password')->passwordInput()->label('Contraseña') ?>

        <div class="row">
            <div class="col-xs-12">
                <?= Html::submitButton('Crear', ['class' => 'btn btn-primary btn-block btn-flat pull-right', 'name' => 'signup-button']) ?>
            </div>
        </div>
        <!--<div class="row"><p>Este usuario se creará con un rol de usuarios asignado. Para modificarlo dirigase a la seccion de asignaciones.</p></div>-->
        <?php ActiveForm::end(); ?>
    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->
