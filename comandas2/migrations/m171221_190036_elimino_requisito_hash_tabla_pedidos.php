<?php

use yii\db\Migration;

/**
 * Class m171221_190036_elimino_requisito_hash_tabla_pedidos
 */
class m171221_190036_elimino_requisito_hash_tabla_pedidos extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->alterColumn('pedidos','hash','VARCHAR(32)');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m171221_190036_elimino_requisito_hash_tabla_pedidos cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171221_190036_elimino_requisito_hash_tabla_pedidos cannot be reverted.\n";

        return false;
    }
    */
}
