<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\productos\models\Categorias */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="categorias-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h4><?= Yii::t('app','Características') ?></h4>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
                            <?= $form->field($model, 'mostrable')->checkbox() ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'descripcion')->textarea(['rows' => 6]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => 'btn btn-success btn-lg pull-right']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
