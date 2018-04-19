<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\productos\models\Categorias */

$this->title = Yii::t('app', 'Nueva Categoría');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Categorías'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categorias-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
