<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\pedidos\models\Pedidos */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Pedidos',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pedidos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="pedidos-update">

    <?= $this->render('_form', [
        'model' => $model,
        'productos' => $productos,
        'mesas'=>$mesas,
    ]) ?>

</div>
