<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\mesas\models\Mesas */

$this->title = Yii::t('app', 'Actualizar {modelClass}: ', [
    'modelClass' => 'Mesa',
]) . $model->nro_mesa;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mesas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nro_mesa, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Actualizar');
?>
<div class="mesas-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
