<?php
use yii\helpers\Html;

/* @var $pedidosHasProductos \app\modules\pedidos\models\PedidosHasProductos*/
?>

<div class="row productoOpcion" style="margin-bottom: 10px;">
    <div class="col-md-3">
        <?php if(isset($pedidosHasProductos)) : ?>
            <b><?=$pedidosHasProductos->productos->nombre?></b>
        <?php else:?>
            <b><?=$producto->nombre?></b>
        <?php endif;?>
    </div>
    <div class="col-md-8">
        <?php
        if(isset($pedidosHasProductos)) {
            echo Html::activeHiddenInput(new \app\modules\pedidos\models\PedidosHasProductos(),'['.$count.']productos_id',['value'=>$pedidosHasProductos->productos->id]);
            if($pedidosHasProductos->opciones) {
                foreach ($pedidosHasProductos->productos->productosHasProductosOpciones as $k => $_productosHasProductosOpciones) {
                    echo $_productosHasProductosOpciones->productosOpciones->nombre.': ';
                    foreach ($_productosHasProductosOpciones->productosOpciones->productosOpcionesHasProductos as $prod) {
                        foreach ($pedidosHasProductos->opciones as $opcion) {
                            if($opcion->productos->id == $prod->productos->id) {
                                echo $opcion->productos->nombre;
                                echo '<input type="hidden" name="PedidosHasProductos[' . $count . '][productos][productosHasProductosOpciones][' . $k . '][productosOpciones][productosOpcionesHasProductos][productos_id]" value="' . $opcion->productos->id . '"/><br>';
                            }
                        }
                    }
                }
            } else {
                echo '<span class="text-muted">- Producto sin opciones -</span>';
            }
        } else {
            echo Html::activeHiddenInput(new \app\modules\pedidos\models\PedidosHasProductos(),'['.$count.']productos_id',['value'=>$producto->id]);
            if($producto->productosHasProductosOpciones) {
                foreach ($producto->productosHasProductosOpciones as $k => $_productosHasProductosOpciones) {
                    $_opciones = [];
                    foreach ($_productosHasProductosOpciones->productosOpciones->productosOpcionesHasProductos as $_productosOpcionesHasProductos) {
                        $_opciones[$_productosOpcionesHasProductos->productos->id] =  $_productosOpcionesHasProductos->productos->nombre;
                    }
                    echo \kartik\select2\Select2::widget([
                        'model' => new \app\modules\pedidos\models\PedidosHasProductos(),
                        'attribute' => '['.$count.'][productos][productosHasProductosOpciones]['.$k.'][productosOpciones][productosOpcionesHasProductos]productos_id',
                        'data' => $_opciones,
                        'language' => 'es',
                        'options' => ['multiple' => false,'id' => $count.'-'.$k,'placeholder'=>$_productosHasProductosOpciones->productosOpciones->nombre, 'style'=>'margin-bottom: 10px;'],
                        'pluginOptions' => [
                            'allowClear' => false,
                        ],
                    ]);
                };
            } else {
                echo 'Producto sin opciones';
            }
        }?>
    </div>
    <div class="col-md-1">
        <button type="button" class="btn btn-danger removeOption" title="Eliminar opción"><span class="fa fa-remove"></span></button>
    </div>
</div>

<?php
$this->registerJs('
$(".removeOption").click(function(){
    $(this).parent().parent().remove();
});
');
