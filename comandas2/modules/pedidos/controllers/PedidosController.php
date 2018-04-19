<?php

namespace app\modules\pedidos\controllers;

use app\modules\mesas\models\Mesas;
use app\modules\productos\models\Productos;
use raoul2000\workflow\helpers\WorkflowHelper;
use Yii;
use app\modules\pedidos\models\Pedidos;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PedidosController implements the CRUD actions for Pedidos model.
 */
class PedidosController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Pedidos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Pedidos::find()->where(['aplicacion_id'=>Yii::$app->session->get('aplicacion_id')]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pedidos model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Pedidos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $post = Yii::$app->request->post();
        $model = new Pedidos();
        $model->aplicacion_id = Yii::$app->session->get('aplicacion_id');

        $productos = Productos::find()->where(['aplicacion_id'=>$model->aplicacion_id,'mostrable'=>true])->all();
        $mesas = Mesas::find()->where(['aplicacion_id'=>$model->aplicacion_id])->all();

        if($model->load($post)) {
            $model->pedidos_has_productos = $post['PedidosHasProductos'];
            if ($model->save()) {
                Yii::$app->session->setFlash('success','Pedido creado correctamente');
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'productos' => $productos,
            'mesas'=>$mesas,
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Pedidos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $post = Yii::$app->request->post();
        $model = $this->findModel($id);

        $productos = Productos::find()->where(['aplicacion_id'=>$model->aplicacion_id,'mostrable'=>true])->all();
        $mesas = Mesas::find()->where(['aplicacion_id'=>$model->aplicacion_id])->all();

        if($model->load($post)) {
            $model->pedidos_has_productos = isset($post['PedidosHasProductos']) ? $post['PedidosHasProductos'] : [];
            if ($model->save()) {
                Yii::$app->session->setFlash('success','Pedido actualizado correctamente');
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'productos' => $productos,
            'mesas'=>$mesas,
            'model' => $model,
        ]);
    }

    public function actionGetOptions($count, $prod_id) {
        $producto = Productos::find()->where(['id'=>$prod_id])->one();
        return $this->renderAjax('partials/_pedidos-has-productos',
            [
                'producto' => $producto,
                'count' => $count
            ]
        );
    }

    /**
     * Deletes an existing Pedidos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionSendToStatus() {
        $key = Yii::$app->request->get('key');
        $id = Yii::$app->request->get('id');
        $model = $this->findModel($id);
        if(WorkflowHelper::isValidNextStatus($model, $key)) {
            $model->sendToStatus($key);
            if($model->save()) {
                Yii::$app->session->setFlash('success','El pedido N° '.$model->id.' ahora se encuentra en el estado '.$model->workflowStatus->label);
            } else {
                Yii::$app->session->setFlash('danger','Se produjo un error al procesar el cambio de estado');
            }
        } else {
            Yii::$app->session->setFlash('danger','El estado destino es incorrecto');
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Pedidos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pedidos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pedidos::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
