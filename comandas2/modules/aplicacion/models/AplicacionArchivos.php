<?php

namespace app\modules\aplicacion\models;

use Yii;

/**
 * This is the model class for table "aplicacion_archivos".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $path
 * @property string $type
 * @property integer $size
 * @property integer $aplicacion_id
 * @property string $key
 *
 * @property Aplicacion $aplicacion
 */
class AplicacionArchivos extends \yii\db\ActiveRecord
{

    const FILE_KEY_IONIC_HOME_PAGE = 'ionic_home_page';
    const FILE_KEY_WEB_LOGO = 'web-logo';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'aplicacion_archivos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['size', 'aplicacion_id'], 'integer'],
            ['key', 'in', 'range' => [self::FILE_KEY_IONIC_HOME_PAGE, self::FILE_KEY_WEB_LOGO]],
            [['nombre', 'path', 'type', 'key'], 'string', 'max' => 255],
            [['aplicacion_id'], 'exist', 'skipOnError' => true, 'targetClass' => Aplicacion::className(), 'targetAttribute' => ['aplicacion_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nombre' => Yii::t('app', 'Nombre'),
            'path' => Yii::t('app', 'Path'),
            'type' => Yii::t('app', 'Type'),
            'size' => Yii::t('app', 'Size'),
            'aplicacion_id' => Yii::t('app', 'Aplicacion'),
            'key' => Yii::t('app', 'Key'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAplicacion()
    {
        return $this->hasOne(Aplicacion::className(), ['id' => 'aplicacion_id']);
    }
}
