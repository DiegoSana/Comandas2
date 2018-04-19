<?php
namespace app\controllers\user;

use app\modules\aplicacion\models\Aplicacion;
use app\modules\aplicacion\models\Empresa;
use app\modules\aplicacion\models\UserAplicacion;
use mdm\admin\controllers\UserController as BaseUserController;
use mdm\admin\models\form\Signup;
use app\models\forms\Login;
use mdm\admin\models\User;
use app\models\searchs\User as UserSearch;
use yii\base\Exception;

class UserController extends BaseUserController
{

    /**
     * Login
     * @return string
     */
    public function actionLogin()
    {
        if (!\Yii::$app->getUser()->isGuest) {
            return $this->goHome();
        }

        $model = new Login();
        if ($model->load(\Yii::$app->getRequest()->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionSignup()
    {
        $this->layout = 'main-login';
        $model = new Signup();
        if ($model->load(\Yii::$app->getRequest()->post())) {
            if ($user = $model->signup()) {
                /*$auth = \Yii::$app->authManager;
                $authorRole = $auth->getRole('usuario');
                $auth->assign($authorRole, $user->getId());*/
                return $this->goHome();
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionCreate()
    {
        $model = new Signup();
        if ($model->load(\Yii::$app->getRequest()->post())) {
            if ($user = $model->signup()) {
                return $this->redirect('/admin/user');
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id) {
        $post = \Yii::$app->getRequest()->post();
        $user = \app\models\User::findIdentity($id);
        $aplicaciones = Aplicacion::find();
        if(!\Yii::$app->user->can('admin'))
            $aplicaciones->where(['empresa_id' => \Yii::$app->user->identity->empresa_id]);
        if(!\Yii::$app->user->can('admin'))
            $empresas = Empresa::find()->where(['id' => \Yii::$app->user->identity->empresa_id])->all();
        else
            $empresas = Empresa::find()->all();

        if($post['User']) {
            try {
                $transaction = \Yii::$app->db->beginTransaction();
                $user->load($post);
                $user->aplicaciones_id = $post['User']['aplicaciones_id'];
                $user->save();
                $transaction->commit();
                \Yii::$app->session->setFlash('success', \Yii::t('app','Usuario actualizado correctamente'));
                return $this->redirect('/admin/user');
            } catch (Exception $e) {
                var_dump($e->getMessage());
                \Yii::$app->session->setFlash('error', \Yii::t('app','No se pudieron actualizar los datos'));
                $transaction->rollBack();
            }
        }
        return $this->render('update', [
            'model' => $user,
            'aplicaciones' => $aplicaciones->all(),
            'empresas' => $empresas
        ]);
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = \app\models\User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}