<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\productos\models\Categorias */

$this->title = Yii::t('app', 'Actualizar {modelClass}: ', [
    'modelClass' => 'Categoría',
]) . $model->nombre;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Categorías'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nombre, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Actualizar');
?>
<div class="categorias-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
