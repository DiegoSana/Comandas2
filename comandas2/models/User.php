<?php namespace app\models;

use app\modules\aplicacion\models\Aplicacion;
use app\modules\aplicacion\models\Empresa;
use app\modules\aplicacion\models\UserAplicacion;
use mdm\admin\models\User as BaseUser;
use yii\base\Exception;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;

/**
 * User model
 *
 * @property integer $aplicacion_id
 * @property array $aplicaciones_id
 */

class User extends BaseUser
{

    public $aplicaciones_id;
    public $aplicacion_id;

    public function rules()
    {
        return ArrayHelper::merge(
            parent::rules(),
            [
                ['empresa_id', 'exist', 'targetClass' => Empresa::className(), 'targetAttribute' => 'id'],
                [['aplicacion_id'], 'safe'],
            ]
        );
    }

    public function attributeLabels()
    {
        return ArrayHelper::merge(
            parent::attributeLabels(),
            [
                'empresa_id' => \Yii::t('app', 'Empresa'),
                'aplicaciones_id' => \Yii::t('app', 'Aplicaciones'),
                'aplicacion_id' => \Yii::t('app', 'Aplicacion')
            ]
        );
    }

    public function attributes()
    {
        $arr = parent::attributes();
        $arr[] = 'aplicacion_id';
        return $arr;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpresa() {
        return $this->hasOne(Empresa::className(), ['id' => 'empresa_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserAplicacion() {
        return $this->hasMany(UserAplicacion::className(), ['user_id' => 'id']);
    }

    public function getAplicacion($id) {
        if(\Yii::$app->user->can('admin')) {
            return Aplicacion::find()->where(['id'=>$id])->one();
        } else {
            if (in_array($id, $this->aplicaciones_id)) {
                return Aplicacion::find()->where(['id'=>$id])->one();
            } else {
                throw new BadRequestHttpException();
            }
        }
    }

    public function getAplicaciones() {
        if(\Yii::$app->user->can('admin')) {
            return Aplicacion::find()->all();
        } else {
            foreach ($this->userAplicacion as $_app) {
                $_apps[] = $_app->aplicacion;
            }
            return $_apps;
        }
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['auth_key' => $token]);
    }

    public function afterFind()
    {
        foreach ($this->getUserAplicacion()->all() as $aplicacion) {
            $this->aplicaciones_id[] = $aplicacion->aplicacion_id;
        }
        parent::afterFind(); // TODO: Change the autogenerated stub
    }

    public function afterSave($insert, $changedAttributes)
    {
        if(!$insert) {
            UserAplicacion::deleteAll(['user_id' => $this->id]);
        }
        if($this->aplicaciones_id) {
            foreach ($this->aplicaciones_id as $app_id) {
                $userAplicacion = new UserAplicacion();
                $userAplicacion->user_id = $this->id;
                $userAplicacion->aplicacion_id = $app_id;
                if (!$userAplicacion->save()) {
                    throw new Exception(\Yii::t('app', 'No se pudieron asociar las aplicaciones al usuario'));
                }
            }
        }

        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
    }

    public function beforeDelete()
    {
        UserAplicacion::deleteAll(['user_id' => $this->id]);
        return parent::beforeDelete(); // TODO: Change the autogenerated stub
    }

}