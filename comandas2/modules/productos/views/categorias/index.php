<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Categorias');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="categorias-index">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <?= Html::a(Yii::t('app','Nuevo'),['/productos/categorias/create'],['class'=>'btn btn-info pull-right'])?>
                </div>
                <div class="box-body">
                    <?php Pjax::begin(); ?>    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            'nombre',
                            'descripcion:ntext',

                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>
                    <?php Pjax::end(); ?></div>
                </div>
            </div>
        </div>
    </div>
</div>
