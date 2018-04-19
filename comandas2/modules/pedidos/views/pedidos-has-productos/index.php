<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use himiklab\thumbnail\EasyThumbnailImage;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Pedidos de cocina');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="pedidos-index">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <?php //echo Html::a(Yii::t('app','Nuevo'),['/pedidos/pedidos/create'],['class'=>'btn btn-info pull-right'])?>
                </div>
                <div class="box-body">
                    <?php Pjax::begin(); ?>    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            [
                                'label' => '',
                                'format' => 'html',
                                'value' => function($model) {
                                    if($model->productos->productosImagen) {
                                        return EasyThumbnailImage::thumbnailImg(
                                            $model->productos->productosImagen->path . '/' . $model->productos->productosImagen->nombre,
                                            70,
                                            70,
                                            EasyThumbnailImage::THUMBNAIL_OUTBOUND,
                                            ['alt' => $model->productos->nombre]
                                        );
                                    } else {
                                        return '';
                                    }
                                }
                            ],
                            'pedidos_id',
                            'pedidos.mesas.nro_mesa',
                            [
                                'attribute' => 'productos.nombre',
                                'format' => 'html',
                                'value' => function($model) {
                                    $opciones = [];
                                    foreach ($model->opciones as $_opciones) {
                                        $opciones[] = $_opciones->productos->nombre;
                                    }
                                    $productos[] = (!isset($opciones) || empty($opciones)) ? '<b>'.$model->productos->nombre.'</b>' : '<b>'.$model->productos->nombre.'</b>'.' <span class="text-muted">('.implode(', ', $opciones).')</span>';
                                    return (isset($productos)) ? implode('<br>',$productos) : '<p class="text-muted">Sin productos</p>';
                                }
                            ],
                            [
                                'attribute' => 'hora_pedido',
                                'value' => function($model) {
                                    return DateTime::createFromFormat('d-m-Y H:i:s',$model->hora_pedido)->format('H:i');
                                }
                            ],
                        ],
                    ]); ?>
                    <?php Pjax::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
