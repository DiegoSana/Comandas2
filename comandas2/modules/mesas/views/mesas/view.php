<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\mesas\models\Mesas */

$this->title = $model->nro_mesa;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mesas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="mesas-view">

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
                                    'nro_mesa',
                                    'posicion',
                                ],
                            ]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
