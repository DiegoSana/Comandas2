<?php

namespace app\modules\productos\models;

use Yii;
use yii\web\BadRequestHttpException;

/**
 * This is the model class for table "categorias".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $descripcion
 * @property boolean $mostrable
 * @property integer $aplicacion_id
 *
 * @property ProductosHasCategorias[] $productosHasCategorias
 * @property Productos[] $productos
 */
class Categorias extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categorias';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'aplicacion_id'], 'required'],
            [['descripcion'], 'string'],
            [['mostrable'], 'boolean'],
            [['aplicacion_id'], 'integer'],
            [['nombre'], 'string', 'max' => 45],
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
            'descripcion' => Yii::t('app', 'Descripcion'),
            'aplicacion_id' => Yii::t('app', 'Aplicacion ID'),
            'mostrable' => Yii::t('app', 'Mostrable en menú'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductosHasCategorias()
    {
        return $this->hasMany(ProductosHasCategorias::className(), ['categorias_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductos()
    {
        return $this->hasMany(Productos::className(), ['id' => 'productos_id'])->viaTable('productos_has_categorias', ['categorias_id' => 'id']);
    }

    public function afterFind()
    {
        if(Yii::$app->session->isActive) {
            if($this->aplicacion_id && $this->aplicacion_id != Yii::$app->session->get('aplicacion_id'))
                throw new BadRequestHttpException();
        } else {
            if($this->aplicacion_id && $this->aplicacion_id != Yii::$app->params['aplicacion_id'])
                throw new BadRequestHttpException();
        }

        parent::afterFind(); // TODO: Change the autogenerated stub
    }
}
