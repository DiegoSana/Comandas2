<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\aplicacion\models\Empresa;
use kartik\file\FileInput;
use app\modules\aplicacion\models\AplicacionArchivos;

/* @var $this yii\web\View */
/* @var $model app\modules\aplicacion\models\Aplicacion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="aplicacion-form">

    <?php $form = ActiveForm::begin([
        'options' => ['data-pjax' => false,'enctype' => 'multipart/form-data'],
    ]); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'empresa_id')->dropDownList(
        ArrayHelper::map(Empresa::find()->all(), 'id', 'nombre'),
        [
            'prompt' => 'Seleccione...'
        ]
    ); ?>

    <?= $form->field($model, 'subdominio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dominio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'config')->textarea() ?>

    <?= $form->field($model, 'ionic_home_image')->widget(FileInput::className(), [
        'options' => [
            'multiple' => false,
            'accept' => 'image/*',
        ],
        'pluginOptions' => [
            'browseIcon' => '<i class="fa fa-file-image-o"></i> ',
            'showPreview' => true,
            'showCaption' => true,
            'showRemove' => false,
            'showUpload' => false,
            'showClose' => false,
            'uploadAsync' => true,
            'showUploadedThumbs' => true,
            'browseLabel' =>  'Seleccionar',
            'allowedFileExtensions'=>['jpg', 'jpeg', 'png'],
            'maxFileCount' => 10,
            'initialPreview' => isset($initialPreviews[AplicacionArchivos::FILE_KEY_IONIC_HOME_PAGE]['imgs']) ? $initialPreviews[AplicacionArchivos::FILE_KEY_IONIC_HOME_PAGE]['imgs'] : [],
            'initialPreviewConfig' => isset($initialPreviews[AplicacionArchivos::FILE_KEY_IONIC_HOME_PAGE]['data']) ? $initialPreviews[AplicacionArchivos::FILE_KEY_IONIC_HOME_PAGE]['data'] : [],
            'initialPreviewAsData' => true,
            'overwriteInitial' => false,
        ],
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
