<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\aplicacion\models\Aplicacion;
use app\modules\aplicacion\models\Empresa;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \mdm\admin\models\User */

$this->title = Yii::t('rbac-admin', 'Edición de usuario: '.$model->username);
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">

    <div class="row">
        <div class="col-md-5 col-md-offset-3">
            <div class="box box-primary">
                <div class="box-body">
                    <?php $form = ActiveForm::begin(['id' => 'form-change']); ?>
                    <?= $form->field($model, 'username') ?>
                    <?= $form->field($model, 'email') ?>
                    <?= $form->field($model, 'empresa_id')->dropDownList(ArrayHelper::map($empresas,'id','nombre'), ['style' => (!Yii::$app->user->can('admin')) ? 'display:none;' : 'display:block;'])->label(Yii::$app->user->can('admin')) ?>
                    <?= $form->field($model, 'aplicaciones_id')->dropDownList(ArrayHelper::map($aplicaciones,'id','nombre'), ['multiple'=>'multiple', 'selected'=>'selected']) ?>
                    <div class="form-group">
                        <?= Html::submitButton(Yii::t('rbac-admin', 'Update'), ['class' => 'btn btn-primary pull-right', 'name' => 'change-button']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
