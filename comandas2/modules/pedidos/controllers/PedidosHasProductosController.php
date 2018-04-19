<?php

namespace app\modules\pedidos\controllers;

use Yii;
use app\modules\pedidos\models\PedidosHasProductos;
use yii\web\Controller;
use yii\data\ActiveDataProvider;

class PedidosHasProductosController extends Controller
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => PedidosHasProductos::find()->alias('PHP')
                ->innerJoin('pedidos P', 'P.id = PHP.pedidos_id')
                ->innerJoin('productos PR', 'PR.id = PHP.productos_id')
                ->where([
                    'PHP.pedidos_has_productos_id'=>null,
                    'P.aplicacion_id'=>Yii::$app->session->get('aplicacion_id'),
                    'PR.preparacion_cocina' => true,
                ]),
            'sort' => ['defaultOrder' => ['hora_pedido' => SORT_ASC]]
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

}
