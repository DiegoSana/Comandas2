<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Pedidos');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="pedidos-index">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <?= Html::a(Yii::t('app','Nuevo'),['/pedidos/pedidos/create'],['class'=>'btn btn-info pull-right'])?>
                </div>
                <div class="box-body">
                    <?php Pjax::begin(); ?>    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            'id',
                            'mesas.nro_mesa',
                            [
                                'label' => 'productos',
                                'format' => 'html',
                                'value' => function($model) {
                                    foreach ($model->pedidosHasProductos as $_pedidosHasProductos) {
                                        $opciones = [];
                                        foreach ($_pedidosHasProductos->opciones as $_opciones) {
                                            $opciones[] = $_opciones->productos->nombre;
                                        }
                                        $productos[] = (!isset($opciones) || empty($opciones)) ? '<b>'.$_pedidosHasProductos->productos->nombre.'</b>' : '<b>'.$_pedidosHasProductos->productos->nombre.'</b>'.' <span class="text-muted">('.implode(', ', $opciones).')</span>';
                                    }
                                    return (isset($productos)) ? implode('<br>',$productos) : '<p class="text-muted">Sin productos</p>';
                                }
                            ],
                            [
                                'attribute' => 'status',
                                'value' => function($model) {
                                    return $model->workflowStatus->label;
                                },
                            ],
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'header' => 'Mover a',
                                'template' => '{transition}',
                                'buttons' => [
                                    'transition' => function($url, $model, $key) {
                                        foreach(\raoul2000\workflow\helpers\WorkflowHelper::getNextStatusListData($model) as $status) {
                                            $buttons[] = Html::a(
                                                $status,
                                                \yii\helpers\Url::to(['/pedidos/pedidos/send-to-status', 'id'=>$model->id, 'key'=>strtolower($status)]),
                                                [
                                                    'title'=>'Enviar a: '.$status,
                                                    'class'=>'btn btn-xs',
                                                    'data-confirm'=>'¿Desea enviar este pedido al estado '.$status.'?'
                                                ]
                                            );
                                        }
                                        return isset($buttons) ? implode(' - ',$buttons) : 'Estado final';
                                    }
                                ]
                            ],
                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>
                    <?php Pjax::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
