<?php

namespace app\api\modules\v1\controllers;

use app\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBearerAuth;

class UserController extends \yii\rest\ActiveController
{

    public $modelClass = 'app\models\User';
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];

    public function behaviors()
    {
        $behaviors = parent::behaviors(); // TODO: Change the autogenerated stub
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
            'cors' => [
                // restrict access to
                'Origin' => ['*'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                // Allow only POST and PUT methods
                'Access-Control-Request-Headers' => ['*'],
                // Allow only headers 'X-Wsse'
                'Access-Control-Allow-Credentials' => null,
                // Allow OPTIONS caching
                'Access-Control-Max-Age' => 3600,
                // Allow the X-Pagination-Current-Page header to be exposed to the browser.
                'Access-Control-Expose-Headers' => [],
            ],

        ];
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::className(),
            'except' => ['index'],
        ];
        return $behaviors;
    }

    public function actions()
    {
        $actions = parent::actions(); // TODO: Change the autogenerated stub
        unset($actions['index']);
        return $actions;
    }

    public function actionIndex()
    {
        $requestParams = Yii::$app->getRequest()->getBodyParams();
        if (empty($requestParams)) {
            $requestParams = Yii::$app->getRequest()->getQueryParams();
        }

        $usersQuery = User::find();

        return Yii::createObject([
            'class' => ActiveDataProvider::className(),
            'query' => $usersQuery,
            'pagination' => [
                'params' => $requestParams,
            ],
            'sort' => [
                'params' => $requestParams,
            ],
        ]);
    }

}
