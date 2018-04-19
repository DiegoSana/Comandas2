<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use himiklab\thumbnail\EasyThumbnailImage;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Productos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="productos-index">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <?= Html::a(Yii::t('app','Nuevo'),['/productos/productos/create'],['class'=>'btn btn-info pull-right'])?>
                </div>
                <div class="box-body">
                    <?php Pjax::begin(); ?>    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'tableOptions' => ['class'=>'table table-bordered table-striped dataTable'],
                        'columns' => [
                            [
                                'label' => '',
                                'format' => 'html',
                                'value' => function($model) {
                                    return Html::img($model->getImage()->getUrl('100x'));
                                }
                            ],
                            'nombre',
                            'descripcion:ntext',
                            'precio',
                            [
                                'attribute' => 'mostrable',
                                'value' => function($model) {
                                    return ($model->mostrable) ? 'Si' : 'No';
                                }
                            ],
                            [
                                'attribute' => 'preparacion_cocina',
                                'value' => function($model) {
                                    return ($model->preparacion_cocina) ? 'Si' : 'No';
                                }
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
