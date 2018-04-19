<?php

namespace app\modules\aplicacion\controllers;

use app\modules\aplicacion\models\AplicacionArchivos;
use rico\yii2images\models\Image;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Yii;
use app\modules\aplicacion\models\Aplicacion;
use yii\base\Exception;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * AplicacionController implements the CRUD actions for Aplicacion model.
 */
class AplicacionController extends Controller
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
     * Lists all Aplicacion models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Aplicacion::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Aplicacion model.
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
     * Creates a new Aplicacion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Aplicacion();

        if (!Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            try {
                $transaction = Yii::$app->db->beginTransaction();
                if (!$model->save()) {
                    throw new Exception('No se pudo crear la aplicación');
                }
                $this->uploadFiles(UploadedFile::getInstances($model, 'ionic_home_image'), $model, AplicacionArchivos::FILE_KEY_IONIC_HOME_PAGE);
                $transaction->commit();
                return $this->redirect(['index']);
            } catch (\Exception $e) {
                Yii::$app->session->setFlash('danger', $e->getMessage());
                $transaction->rollBack();
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Aplicacion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        foreach ($model->getImages() as $archivo) {
            /* @var $archivo Image*/
            if($archivo->urlAlias == 'placeHolder')
                break;
            $initialPreviews[AplicacionArchivos::FILE_KEY_IONIC_HOME_PAGE]['imgs'][] = Url::to($archivo->getUrl(), true);
            $initialPreviews[AplicacionArchivos::FILE_KEY_IONIC_HOME_PAGE]['data'][] = [
                'type' => 'image',
                'caption' => $archivo->name,
                'size' => '',
                'key' => $archivo->id,
                'url' => Yii::$app->urlManager->createAbsoluteUrl(['/aplicacion/aplicacion/delete-file']),
            ];
        }

        if (!Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            try {
                $transaction = Yii::$app->db->beginTransaction();
                if (!$model->save()) {
                    throw new Exception('No se pudo actualizar la aplicación');
                }
                $this->uploadFiles(UploadedFile::getInstances($model, 'ionic_home_image'), $model, AplicacionArchivos::FILE_KEY_IONIC_HOME_PAGE);
                $transaction->commit();
                return $this->redirect(['index']);
            } catch (\Exception $e) {
                Yii::$app->session->setFlash('danger', $e->getMessage());
                $transaction->rollBack();
            }
        }

        return $this->render('update', [
            'model' => $model,
            'initialPreviews' => $initialPreviews,
        ]);
    }

    protected function uploadFiles($archivos, $model, $file_type) {
        foreach ($archivos as $archivo) {
            /* @var $archivo UploadedFile */
            $model->attachImage($archivo->tempName);
        }
    }

    public function actionDeleteFile() {
        $key = Yii::$app->request->post('key');
        $image = Image::findOne(['id' => $key]);
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $image->delete();
    }

    /**
     * Deletes an existing Aplicacion model.
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
     * Finds the Aplicacion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Aplicacion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Aplicacion::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
