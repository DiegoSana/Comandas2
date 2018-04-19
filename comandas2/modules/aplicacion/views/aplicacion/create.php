<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\aplicacion\models\Aplicacion */

$this->title = Yii::t('app', 'Nueva Aplicación');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Aplicaciones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aplicacion-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
