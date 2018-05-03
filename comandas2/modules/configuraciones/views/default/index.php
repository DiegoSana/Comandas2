<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\file\FileInput;
use app\modules\aplicacion\models\AplicacionArchivos;

\app\assets\AppAsset::register($this);

$this->title = Yii::t('app', 'Configuraciones');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="configuraciones-default-index">
    <?php \yii\widgets\Pjax::begin(['id'=>'pjax-proveedor', 'enablePushState' => false]);?>
    <?php $form = ActiveForm::begin([
        'options' => ['data-pjax' => false],
    ]); ?>
    <div class="row">
        <div class="col-md-12">
            <?= $form->errorSummary($aplicacion)?>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h4><?= Yii::t('app','Configuraciones de la aplicación móbil') ?></h4>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($aplicacion, 'instagram_page_name', [
                                    'template' => '
                                        {label}
                                        <div class="input-group col-sm-12">
                                            <span class="input-group-addon"  style="background-color: #eee;">
                                                <span class="fa fa-instagram"></span>
                                                <span class="text-muted">https://www.instagram.com/</span>
                                            </span>          
                                            {input}
                                        </div>
                                        {error}{hint}'
                            ])->textInput(['placeholder'=>'mipaginadeinstagram']);?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($aplicacion, 'facebook_page_name', [
                                    'template' => '
                                        {label}
                                        <div class="input-group col-sm-12 ">
                                            <span class="input-group-addon" style="background-color: #eee;">
                                                <span class="fa fa-facebook-square"></span>
                                                <span class="text-muted">https://www.facebook.com/</span>
                                            </span>          
                                            {input}
                                        </div>
                                        {error}{hint}'
                            ])->textInput(['placeholder'=>'mipaginadefacebook']);?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($aplicacion, 'ionic_home_image')->widget(FileInput::className(), [
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
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => 'btn btn-success pull-right']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
    <?php \yii\widgets\Pjax::end();?>
</div>
