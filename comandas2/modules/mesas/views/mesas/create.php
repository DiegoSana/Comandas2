<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\mesas\models\Mesas */

$this->title = Yii::t('app', 'Nueva Mesa');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mesas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mesas-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
