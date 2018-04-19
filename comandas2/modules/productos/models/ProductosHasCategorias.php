<?php

namespace app\modules\productos\models;

use Yii;

/**
 * This is the model class for table "productos_has_categorias".
 *
 * @property integer $productos_id
 * @property integer $categorias_id
 *
 * @property Categorias $categorias
 * @property Productos $productos
 */
class ProductosHasCategorias extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'productos_has_categorias';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['productos_id', 'categorias_id'], 'required'],
            [['productos_id', 'categorias_id'], 'integer'],
            [['categorias_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categorias::className(), 'targetAttribute' => ['categorias_id' => 'id']],
            [['productos_id'], 'exist', 'skipOnError' => true, 'targetClass' => Productos::className(), 'targetAttribute' => ['productos_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'productos_id' => Yii::t('app', 'Productos ID'),
            'categorias_id' => Yii::t('app', 'Categorias ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategorias()
    {
        return $this->hasOne(Categorias::className(), ['id' => 'categorias_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductos()
    {
        return $this->hasOne(Productos::className(), ['id' => 'productos_id']);
    }
}
