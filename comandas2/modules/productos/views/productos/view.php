<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\productos\models\Productos */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Productos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="productos-view">

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h4><?= Yii::t('app','Características') ?></h4>
                </div>
                <div class="box-body">
                    <div class="row text-right">
                        <div class="col-md-12 " style="margin-bottom: 10px;">
                            <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                            <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                                'class' => 'btn btn-danger',
                                'data' => [
                                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                    'method' => 'post',
                                ],
                            ]) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?= DetailView::widget([
                                'model' => $model,
                                'attributes' => [
                                    'nombre',
                                    'descripcion:ntext',
                                    'precio',
                                    [
                                        'attribute' => 'mostrable',
                                        'value' => function($model) {
                                            return $model->mostrable ? 'Si' : 'No';
                                        }
                                    ],
                                    [
                                        'attribute' => 'preparacion_cocina',
                                        'value' => function($model) {
                                            return $model->preparacion_cocina ? 'Si' : 'No';
                                        }
                                    ],
                                ],
                            ]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h4><?= Yii::t('app','Imágenes') ?></h4>
                </div>
                <div class="box-body">
                    <?php foreach ($model->productosImagenes as $_productosImagenes) {
                        echo '<div class="col-md-3">';
                        echo '<img class="img-thumbnail" src="'.Url::to('@web/'.$_productosImagenes->path.'/'.$_productosImagenes->nombre).'" alt="Image">';
                        echo '</div>';
                    }
                    if(!$model->productosImagenes) {
                        echo '<div class="col-md-12 text-center">';
                        echo '<p class="text-muted">'.Yii::t('app','No hay imágenes').'</p>';
                        echo '</div>';
                    }?>
                </div>
            </div>
        </div>
    </div>
</div>
