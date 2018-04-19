<?php

use yii\db\Migration;

/**
 * Class m171220_223619_yii2workflow_fields_delete_pedidos_estados_y_pedidos_has_productos_estados
 */
class m171220_223619_yii2workflow_fields_delete_pedidos_estados_y_pedidos_has_productos_estados extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        //$this->dropForeignKey('fk_pedidos_pedidos_estados1','pedidos');
        //$this->dropColumn('pedidos','pedidos_estados_id');
        //$this->dropForeignKey('fk_pedidos_has_productos_pedidos_has_productos_estados1','pedidos_has_productos');
        //$this->dropColumn('pedidos_has_productos','pedidos_has_productos_estados_id');
        //$this->dropTable('pedidos_estados');
        //$this->dropTable('pedidos_has_productos_estados');
        $this->addColumn('pedidos','status','VARCHAR(40)');
        $this->addColumn('pedidos_has_productos','status','VARCHAR(40)');
        $this->createTable('aplicacion_configuraciones',['id'=>'INT(11)','aplicacion_id'=>'INT(11)','type'=>'VARCHAR(40)','value'=>'TEXT']);
        $this->addForeignKey('fk_aplicacion_configuraciones_aplicacion','aplicacion_configuraciones','aplicacion_id','aplicacion','id');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m171220_223619_yii2workflow_fields_delete_pedidos_estados_y_pedidos_has_productos_estados cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171220_223619_yii2workflow_fields_delete_pedidos_estados_y_pedidos_has_productos_estados cannot be reverted.\n";

        return false;
    }
    */
}
