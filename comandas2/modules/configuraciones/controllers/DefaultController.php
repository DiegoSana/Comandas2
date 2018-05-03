<?php

namespace app\modules\configuraciones\controllers;

use app\modules\aplicacion\models\Aplicacion;
use app\modules\aplicacion\models\AplicacionArchivos;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use yii\base\Exception;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\UploadedFile;
use rico\yii2images\models\Image;

/**
 * Default controller for the `configuraciones` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $aplicacion = Aplicacion::findOne(\Yii::$app->session->get('aplicacion_id'));

        foreach ($aplicacion->getImages() as $archivo) {
            /* @var $archivo Image*/
            if($archivo->urlAlias == 'placeHolder')
                break;
            $initialPreviews[AplicacionArchivos::FILE_KEY_IONIC_HOME_PAGE]['imgs'][] = Url::to($archivo->getUrl(), true);
            $initialPreviews[AplicacionArchivos::FILE_KEY_IONIC_HOME_PAGE]['data'][] = [
                'type' => 'image',
                'caption' => $archivo->name,
                'size' => '',
                'key' => $archivo->id,
                'url' => \Yii::$app->urlManager->createAbsoluteUrl(['/configuraciones/default/delete-file']),
            ];
        }

        if($aplicacion->load(\Yii::$app->request->post())) {
            try {
                $transaction = \Yii::$app->db->beginTransaction();
                if (!$aplicacion->save()) {
                    throw new Exception('No se pudo actualizar la configuración');
                }
                $this->uploadFiles(UploadedFile::getInstances($aplicacion, 'ionic_home_image'), $aplicacion, AplicacionArchivos::FILE_KEY_IONIC_HOME_PAGE);
                $transaction->commit();
                \Yii::$app->session->setFlash('success','La configuración fue actualizada');
            } catch (Exception $e) {
                \Yii::$app->session->setFlash('danger', $e->getMessage());
                $transaction->rollBack();
            }
        }

        return $this->render('index', [
            'aplicacion' => $aplicacion,
            'initialPreviews' => $initialPreviews,
        ]);
    }

    protected function uploadFiles($archivos, $model, $file_type) {
        foreach ($archivos as $archivo) {
            /* @var $archivo UploadedFile */
            $model->attachImage($archivo->tempName);
        }
    }

    public function actionDeleteFile()
    {
        $key = \Yii::$app->request->post('key');
        $image = Image::findOne(['id' => $key]);
        if(!(\Yii::$app->user->can('admin') || (\Yii::$app->user->can('administrador') && in_array($image->itemId, \Yii::$app->user->identity->aplicaciones_id)))) {
            throw new AccessDeniedException();
        }
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $image->delete();
    }
}
