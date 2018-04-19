<?php

use yii\db\Migration;

/**
 * Class m171220_013249_delete_productos_opciones_has_productos_fk
 */
class m171220_013249_delete_productos_opciones_has_productos_fk extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->dropForeignKey('fk_productos_opciones_has_productos_productos1','productos_opciones_has_productos');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m171220_013249_delete_productos_opciones_has_productos_fk cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171220_013249_delete_productos_opciones_has_productos_fk cannot be reverted.\n";

        return false;
    }
    */
}
