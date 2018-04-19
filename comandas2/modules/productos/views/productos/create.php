<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\productos\models\Productos */

$this->title = Yii::t('app', 'Nuevo Producto');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Productos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="productos-create">

    <?= $this->render('_form', [
        'model' => $model,
        'categorias' => $categorias,
        'productosOpcionesHasProductos' => $productosOpcionesHasProductos
    ]) ?>

</div>
