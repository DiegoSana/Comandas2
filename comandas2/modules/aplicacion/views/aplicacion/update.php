<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\aplicacion\models\Aplicacion */

$this->title = Yii::t('app', 'Editar {modelClass}: ', [
    'modelClass' => 'Aplicacion',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Aplicacions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="aplicacion-update">

    <?= $this->render('_form', [
        'model' => $model,
        'initialPreviews' => $initialPreviews,
    ]) ?>

</div>
