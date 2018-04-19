<?php

use yii\db\Migration;

/**
 * Class m171221_195350_tabla_pedidos_has_productos_cambio_itpo_a_pedidos_has_productos_id
 */
class m171221_195350_tabla_pedidos_has_productos_cambio_itpo_a_pedidos_has_productos_id extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->alterColumn('pedidos_has_productos','pedidos_has_productos_id','BIGINT(20)');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m171221_195350_tabla_pedidos_has_productos_cambio_itpo_a_pedidos_has_productos_id cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171221_195350_tabla_pedidos_has_productos_cambio_itpo_a_pedidos_has_productos_id cannot be reverted.\n";

        return false;
    }
    */
}
