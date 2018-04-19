<?php

namespace app\modules\productos\models;

use Yii;

/**
 * This is the model class for table "productos_opciones_has_productos".
 *
 * @property integer $productos_opciones_id
 * @property integer $productos_id
 *
 * @property Productos $productos
 * @property ProductosOpciones $productosOpciones
 */
class ProductosOpcionesHasProductos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'productos_opciones_has_productos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['productos_opciones_id', 'productos_id'], 'required'],
            [['productos_opciones_id', 'productos_id'], 'integer'],
            [['productos_id'], 'exist', 'skipOnError' => true, 'targetClass' => Productos::className(), 'targetAttribute' => ['productos_id' => 'id']],
            [['productos_opciones_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductosOpciones::className(), 'targetAttribute' => ['productos_opciones_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'productos_opciones_id' => Yii::t('app', 'Productos Opciones ID'),
            'productos_id' => Yii::t('app', 'Productos ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductos()
    {
        return $this->hasOne(Productos::className(), ['id' => 'productos_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductosOpciones()
    {
        return $this->hasOne(ProductosOpciones::className(), ['id' => 'productos_opciones_id']);
    }
}
