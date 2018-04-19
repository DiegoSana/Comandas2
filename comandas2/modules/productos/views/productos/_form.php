<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\file\FileInput;
use app\modules\productos\models\Productos;
use app\modules\productos\models\ProductosOpcionesHasProductos;
use app\modules\productos\models\ProductosOpciones;

/* @var $this yii\web\View */
/* @var $model app\modules\productos\models\Productos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="productos-form">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h4><?= Yii::t('app','Features') ?></h4>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'categorias_id')->widget(Select2::classname(), [
                                'data' => ArrayHelper::map($categorias,'id','nombre'),
                                'language' => 'es',
                                'options' => ['multiple' => 'multiple'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]);?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <?= $form->field($model, 'precio')->textInput() ?>
                        </div>
                        <div class="col-md-3" style="margin-top: 30px;">
                            <?= $form->field($model, 'mostrable')->checkbox() ?>
                        </div>
                        <div class="col-md-3" style="margin-top: 30px;">
                            <?= $form->field($model, 'preparacion_cocina')->checkbox() ?>
                        </div>
                        <div class="col-md-3" style="margin-top: 30px;">
                            <?= $form->field($model, 'es_opcion')->checkbox() ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?= $form->field($model, 'descripcion')->textarea(['rows' => 4]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h4><?= Yii::t('app','Opciones del producto') ?> <?= Html::button(Yii::t('app', 'Agregar opción'),['class'=>'btn btn-primary addOption pull-right', 'title'=>Yii::t('app', 'Agregar opción')])?></h4>
                </div>
                <div class="box-body productoOpciones">
                    <?php foreach ($model->productosHasProductosOpciones as $k => $_productosHasProductosOpciones): ?>
                        <?= $this->context->actionGetOption($k, $_productosHasProductosOpciones->productosOpciones)?>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
    </div>
    <?php if (!$model->isNewRecord):?>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h4><?= Yii::t('app','Images') ?></h4>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <?= $form->field($model, 'images[]')->widget(FileInput::classname(), [
                                    'options' => [
                                        'multiple' => true,
                                        'accept' => 'image/*',
                                    ],
                                    'pluginOptions' => [
                                        'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                                        'showPreview' => true,
                                        'showCaption' => true,
                                        'showRemove' => true,
                                        'showUpload' => true,
                                        'showClose' => false,
                                        'uploadAsync' => false,
                                        'showRemove' => false,
                                        'showUploadedThumbs' => false,
                                        'browseLabel' =>  'Seleccionar',
                                        'allowedFileExtensions'=>['jpg', 'jpeg','gif','png'],
                                        //'uploadUrl' => \yii\helpers\Url::to(['/productos/productos/upload-img?id='.$model->id]),
                                        'maxFileCount' => 10,
                                        'initialPreview' => isset($preview['initialPreview']) ? $preview['initialPreview'] : [],
                                        'initialPreviewConfig' => isset($preview['initialPreviewConfig']) ? $preview['initialPreviewConfig'] : [],
                                        'append' => isset($preview['append']) ? $preview['append'] : false,
                                        'overwriteInitial' => false,
                                    ],
                                ])->label(false);?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif;?>
    <div class="form-group">
        <div class="row">
            <div class="col-md-2 col-md-offset-10">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => 'btn btn-lg btn-success']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$this->registerJs('
$(".addOption").click(function(){
    $.get("'.\yii\helpers\Url::to(['/productos/productos/get-option']).'", {count: $( ".productoOpcion" ).length} ).done(function( data ){
         $( ".productoOpciones" ).append(data);
    });
});
');