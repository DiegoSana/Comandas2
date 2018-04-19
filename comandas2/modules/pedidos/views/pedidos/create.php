<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\pedidos\models\Pedidos */

$this->title = Yii::t('app', 'Nuevo Pedido');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pedidos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pedidos-create">

    <?= $this->render('_form', [
        'productos' => $productos,
        'mesas'=>$mesas,
        'model' => $model,
    ]) ?>

</div>
