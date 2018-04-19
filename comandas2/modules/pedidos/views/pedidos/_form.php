<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\modules\pedidos\models\Pedidos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pedidos-form">
<?php \yii\widgets\Pjax::begin(['id'=>'pjax-proveedor', 'enablePushState' => false]);?>
    <?php $form = ActiveForm::begin([
        'options' => ['data-pjax' => true],
    ]); ?>
    <div class="row">
        <div class="col-md-12">
            <?= $form->errorSummary($model)?>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h4><?= Yii::t('app','Pedido') ?></h4>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-3 col-md-offset-1">
                            <?= $form->field($model, 'mesas_id')->widget(Select2::classname(), [
                                'data' => ArrayHelper::map($mesas,'id','nro_mesa'),
                                'language' => 'es',
                                'options' => ['multiple' => false],
                                'pluginOptions' => [
                                    'allowClear' => false
                                ],
                            ]);?>
                        </div>
                        <div class="col-md-3">
                            <label><?= Yii::t('app','Agregar producto')?></label>
                            <?= Select2::widget([
                                'name' => 'no_importa',
                                'data' => ArrayHelper::map($productos,'id','nombre'),
                                'language' => 'es',
                                'options' => ['multiple' => false],
                                'pluginOptions' => [
                                    'allowClear' => false
                                ],
                            ])?>
                        </div>
                        <div class="col-md-3" style="padding-top: 24px;">
                            <?= Html::button('<span class="fa fa-plus"></span> Agregar al pedido', ['class'=>'angregarProducto btn btn-success'])?>
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
                    <h4><?= Yii::t('app','Productos') ?></h4>
                </div>
                <div class="box-body">
                    <div class="col-md-12">
                        <div class="productosOpciones">
                            <?php foreach ($model->pedidosHasProductos as $key => $pedidosHasProductos) {
                                /* @var $pedidosHasProductos \app\modules\pedidos\models\PedidosHasProductos*/
                                echo $this->render('partials/_pedidos-has-productos', [
                                    'producto' => $pedidosHasProductos->productos,
                                    'count' => $key,
                                    'pedidosHasProductos' => $pedidosHasProductos
                                ]);
                            }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a('Volver',['index'], ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary pull-right']) ?>
    </div>

    <?php ActiveForm::end(); ?>
<?php \yii\widgets\Pjax::end();?>
</div>

<?php
$this->registerJs('
$(".angregarProducto").click(function(){
    $.get("'.\yii\helpers\Url::to(['/pedidos/pedidos/get-options']).'", {count: $( ".productoOpcion" ).length, prod_id: $( "select[name*=no_importa]" ).val()} ).done(function( data ){
         $( ".productosOpciones" ).append(data);
    });
});
');