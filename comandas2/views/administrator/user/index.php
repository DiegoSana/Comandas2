<?php

use yii\helpers\Html;
use yii\grid\GridView;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel mdm\admin\models\searchs\User */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('rbac-admin', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-index">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <?= Html::a(Yii::t('app','Nuevo'),['/admin/user/create'],['class'=>'btn btn-info pull-right'])?>
                </div>
                <div class="box-body">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'tableOptions' => ['class'=>'table table-bordered table-striped dataTable'],
                        'columns' => [
                            'username',
                            'email:email',
                            'created_at:date',
                            [
                                'attribute' => 'status',
                                'value' => function($model) {
                                    return $model->status == 0 ? Yii::t('app','Inactive') : Yii::t('app','Active');
                                },
                                'filter' => [
                                    0 => Yii::t('app','Inactive'),
                                    10 => Yii::t('app','Active'),
                                ]
                            ],
                            [
                                'attribute' =>'empresa_id',
                                'value' => function($model) {
                                    return $model->empresa->nombre;
                                },
                            ],
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'template' => Helper::filterActionColumn(['view', 'activate', 'delete', 'update']),
                                'buttons' => [
                                    'activate' => function($url, $model) {
                                        if ($model->status == 10) {
                                            return '';
                                        }
                                        $options = [
                                            'title' => Yii::t('rbac-admin', 'Activate'),
                                            'aria-label' => Yii::t('rbac-admin', 'Activate'),
                                            'data-confirm' => Yii::t('rbac-admin', 'Are you sure you want to activate this user?'),
                                            'data-method' => 'post',
                                            'data-pjax' => '0',
                                        ];
                                        return Html::a('<span class="glyphicon glyphicon-ok"></span>', $url, $options);
                                    },
                                    'update' => function($url, $model) {
                                        $options = [
                                            'title' => Yii::t('rbac-admin', 'Update'),
                                            'aria-label' => Yii::t('rbac-admin', 'Update'),
                                            'data-method' => 'post',
                                            'data-pjax' => '0',
                                        ];
                                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, $options);
                                    }
                                    ]
                                ],
                            ],
                    ]);?>
                </div>
            </div>
        </div>
    </div>
</div>
