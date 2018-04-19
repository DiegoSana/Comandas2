<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Aplicaciones');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aplicacion-index">

    <p>
        <?= Html::a(Yii::t('app', 'Nueva Aplicacion'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'nombre',
            'empresa.nombre',
            'subdominio',
            'dominio',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
