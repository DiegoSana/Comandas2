<?php

namespace app\modules\pedidos\models;

use raoul2000\workflow\base\SimpleWorkflowBehavior;
use raoul2000\workflow\helpers\WorkflowHelper;
use raoul2000\workflow\source\file\WorkflowDefinitionLoader;
use raoul2000\workflow\validation\WorkflowScenario;
use raoul2000\workflow\validation\WorkflowValidator;
use Yii;
use app\modules\aplicacion\models\Aplicacion;
use app\modules\mesas\models\Mesas;
use yii\base\Exception;
use yii\helpers\ArrayHelper;
use app\models\workflows\PedidosWorkflow;

/**
 * This is the model class for table "pedidos".
 *
 * @property integer $id
 * @property integer $mesas_id
 * @property string $hash
 * @property string $qr_image
 * @property integer $aplicacion_id
 *
 * @property Aplicacion $aplicacion
 * @property Mesas $mesas
 * @property PedidosHasProductos[] $pedidosHasProductos
 */
class Pedidos extends \yii\db\ActiveRecord
{
    public $pedidos_has_productos;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pedidos';
    }

    public function behaviors()
    {
        return [
            SimpleWorkflowBehavior::className()
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mesas_id', 'aplicacion_id'], 'required'],
            [['mesas_id', 'aplicacion_id'], 'integer'],
            [['hash'], 'string', 'max' => 32],
            [['qr_image'], 'string', 'max' => 300],
            [['aplicacion_id'], 'exist', 'skipOnError' => true, 'targetClass' => Aplicacion::className(), 'targetAttribute' => ['aplicacion_id' => 'id']],
            [['mesas_id'], 'exist', 'skipOnError' => true, 'targetClass' => Mesas::className(), 'targetAttribute' => ['mesas_id' => 'id']],
            [['status'],'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Nro pedido'),
            'mesas_id' => Yii::t('app', 'Mesa'),
            'hash' => Yii::t('app', 'Hash'),
            'qr_image' => Yii::t('app', 'Qr Image'),
            'aplicacion_id' => Yii::t('app', 'Aplicacion ID'),
            'status' => Yii::t('app', 'Estado'),
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
    public function getMesas()
    {
        return $this->hasOne(Mesas::className(), ['id' => 'mesas_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidosHasProductos()
    {
        return $this->hasMany(PedidosHasProductos::className(), ['pedidos_id' => 'id'])->andWhere(['pedidos_has_productos_id'=>null]);
    }

    public function afterSave($insert, $changedAttributes)
    {
        if($this->pedidos_has_productos || is_array($this->pedidos_has_productos)) {
            PedidosHasProductos::deleteAll(['pedidos_id'=>$this->id]);
            foreach ($this->pedidos_has_productos as $_pedidosHasProductos) {
                $pedidosHasProductos = new PedidosHasProductos();
                $pedidosHasProductos->pedidos_id = $this->id;
                $pedidosHasProductos->productos_id = $_pedidosHasProductos['productos_id'];
                $pedidosHasProductos->save();
                $pedidos_has_productos_id = $pedidosHasProductos->id;
                if(isset($_pedidosHasProductos['productos']['productosHasProductosOpciones'])) {
                    foreach ($_pedidosHasProductos['productos']['productosHasProductosOpciones'] as $_productosHasProductosOpciones) {
                        $pedidosHasProductos = new PedidosHasProductos();
                        $pedidosHasProductos->pedidos_id = $this->id;
                        $pedidosHasProductos->productos_id = $_productosHasProductosOpciones['productosOpciones']['productosOpcionesHasProductos']['productos_id'];
                        $pedidosHasProductos->pedidos_has_productos_id = $pedidos_has_productos_id;
                        $pedidosHasProductos->save();
                    }
                }
            }
        }
        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
    }

    public function beforeSave($insert)
    {
        if($insert) {
            try {
                $this->sendToStatus('iniciado');
            } catch (Exception $e) {
                $this->addError('status', 'El estado solicitado es incorrecto');
                return false;
            }
        }

        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    public function beforeDelete()
    {
        PedidosHasProductos::deleteAll(['pedidos_id'=>$this->id]);
        return parent::beforeDelete(); // TODO: Change the autogenerated stub
    }
}
