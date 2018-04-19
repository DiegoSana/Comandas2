<?php

namespace app\modules\aplicacion\models;

use Yii;
use app\models\User;

/**
 * This is the model class for table "user_aplicacion".
 *
 * @property integer $user_id
 * @property integer $aplicacion_id
 *
 * @property Aplicacion $aplicacion
 * @property User $user
 */
class UserAplicacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_aplicacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'aplicacion_id'], 'required'],
            [['user_id', 'aplicacion_id'], 'integer'],
            [['aplicacion_id'], 'exist', 'skipOnError' => true, 'targetClass' => Aplicacion::className(), 'targetAttribute' => ['aplicacion_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('app', 'User ID'),
            'aplicacion_id' => Yii::t('app', 'Aplicacion ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAplicacion()
    {
        return $this->hasOne(Aplicacion::className(), ['id' => 'aplicacion_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
