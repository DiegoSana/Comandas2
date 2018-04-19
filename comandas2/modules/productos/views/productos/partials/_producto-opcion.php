<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

$selectid = 'option'.$count;
foreach ($productoOpciones->productosOpcionesHasProductos as $_productosOpcionesHasProductos) {
    $values[] = $_productosOpcionesHasProductos->productos_id;
}
?>
<div class="row productoOpcion">
    <div class="col-md-5">
        <div class="form-group field-productosopciones-0-nombre required">
            <?= Html::activeInput('text', $productoOpciones, '['.$count.']nombre', ['class'=>'form-control', 'placeholder' =>'Nombre de la opción (Ej: Guarnición)']);?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group field-productosopciones-0-productos_opciones_has_productos">
            <?php
            echo Select2::widget([
                'name' => 'ProductosOpciones['.$count.'][productos_opciones_has_productos][]',
                'value' => $values ? $values : '',
                'data' => ArrayHelper::map($productosOpcionesHasProductos,'id','nombre'),
                'options' => ['multiple' => true, 'placeholder' => Yii::t('app','Seleccione las opciones...'),'id' => $selectid]
            ]);
            ?>
        </div>
    </div>
    <div class="col-md-1">
        <?= Html::button('<span class ="fa fa-remove">',['class'=>'btn btn-danger removeOption', 'title'=>'Eliminar opción']);?>
    </div>
</div>

<?php
$this->registerJs('
$(".removeOption").click(function(){
    $(this).parent().parent().remove();
});
');