<?php

namespace app\modules\productos\controllers;

use app\modules\aplicacion\models\Aplicacion;
use app\modules\productos\models\Categorias;
use app\modules\productos\models\ProductosHasProductosOpciones;
use app\modules\productos\models\ProductosImagenes;
use app\modules\productos\models\ProductosOpciones;
use rico\yii2images\models\Image;
use Yii;
use app\modules\productos\models\Productos;
use yii\base\Exception;
use yii\base\Response;
use yii\bootstrap\Html;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProductosController implements the CRUD actions for Productos model.
 */
class ProductosController extends Controller
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
     * Lists all Productos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $productos = Productos::find()->where(['aplicacion_id'=>Yii::$app->session->get('aplicacion_id')]);
        $dataProvider = new ActiveDataProvider([
            'query' => $productos,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Productos model.
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
     * Creates a new Productos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $post = Yii::$app->request->post();
        $model = new Productos();
        $model->aplicacion_id = Yii::$app->session->get('aplicacion_id');
        $categorias = Categorias::find()->where(['aplicacion_id'=>$model->aplicacion_id])->all();
        $productosOpcionesHasProductos = Productos::find()->where([ 'aplicacion_id'=>Yii::$app->session->get('aplicacion_id')])->all();

        if ($model->load($post)) {
            $model->categorias_id = $post['Productos']['categorias_id'];
            $model->images = UploadedFile::getInstances($model, 'images');
            if(isset($post['ProductosOpciones']) && is_array($post['ProductosOpciones'])) {
                $model->productos_opciones = $post['ProductosOpciones'];
            }
            if($model->save()) {
                Yii::$app->session->setFlash('success', Yii::t('app','El producto se ha creado correctamente'));
                return $this->redirect(['productos/update?id='.$model->id]);
            }
        }
        return $this->render('create', [
            'model' => $model,
            'categorias' => $categorias,
            'productosOpcionesHasProductos' => $productosOpcionesHasProductos
        ]);
    }

    public function actionGetOption($count, ProductosOpciones $productoOpcion = null) {

        $productosOpcionesHasProductos = Productos::find()->where(['es_opcion'=>true, 'aplicacion_id'=>Yii::$app->session->get('aplicacion_id')])->all();
        if(Yii::$app->request->isAjax) {
            return $this->renderAjax('partials/_producto-opcion', [
                'productosOpcionesHasProductos' => $productosOpcionesHasProductos,
                'count' => (int) $count,
                'productoOpciones' => $productoOpcion ? $productoOpcion : new ProductosOpciones()
            ]);
        } else {
            return $this->renderPartial('partials/_producto-opcion', [
                'productosOpcionesHasProductos' => $productosOpcionesHasProductos,
                'count' => (int) $count,
                'productoOpciones' => $productoOpcion ? $productoOpcion : new ProductosOpciones()
            ]);
        }
    }
    /**
     * Updates an existing Productos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $post = Yii::$app->request->post();
        $model = $this->findModel($id);
        $categorias = Categorias::find()->where(['aplicacion_id'=>$model->aplicacion_id])->all();
        /*foreach ($model->productosImagenes as $_productoImagen) {
            $preview['initialPreview'][] = '<img src="'.Url::to('@web/'.$_productoImagen->path.'/'.$_productoImagen->nombre).'" style="max-width:100%;max-height:100%;"/>';
            $preview['initialPreviewConfig'][] = [
                'caption'=>$_productoImagen->nombre,
                'width' => '100px',
                'key' => $_productoImagen->id,
                'url' => Yii::$app->urlManager->createAbsoluteUrl(['/productos/productos/delete-img']),
            ];
        }*/

        foreach ($model->getImages() as $archivo) {
            /* @var $archivo Image*/
            if($archivo->urlAlias == 'placeHolder')
                break;
            $preview['initialPreview'][] = Html::img(Url::to($archivo->getUrl('200x'), true));
            $preview['initialPreviewConfig'][] = [
                'caption'=>$archivo->name,
                'width' => '',
                'key' => $archivo->id,
                'url' => Yii::$app->urlManager->createAbsoluteUrl(['/productos/productos/delete-img']),
            ];
        }

        if ($model->load($post)) {
            $model->categorias_id = $post['Productos']['categorias_id'];
            $this->actionUploadImg(UploadedFile::getInstances($model, 'images'), $model);
            if(isset($post['ProductosOpciones']) && is_array($post['ProductosOpciones'])) {
                $model->productos_opciones = $post['ProductosOpciones'];
            }
            if($model->save()) {
                Yii::$app->session->setFlash('success', Yii::t('app','El producto se ha actualizado correctamente'));
                return $this->redirect(['index']);
            }
        }
        return $this->render('update', [
            'model' => $model,
            'categorias' => $categorias,
            'preview' => isset($preview) ? $preview : [],
        ]);
    }

    public function actionUploadImg($archivos, Productos $model) {

        try {
            foreach ($archivos as $archivo) {
                /* @var $archivo UploadedFile */
                $model->attachImage($archivo->tempName);
            }
            return true;
        } catch (Exception $e) {
            $model->addError('images', 'No se pudo subir la imagen');
            return false;
        }
    }

    public function actionDeleteImg() {
        $key = Yii::$app->request->post('key');
        $image = Image::findOne(['id' => $key]);
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $image->delete();
    }

    /**
     * Deletes an existing Productos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Productos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Productos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Productos::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
