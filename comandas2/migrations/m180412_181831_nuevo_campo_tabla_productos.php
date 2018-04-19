<?php

use yii\db\Migration;

/**
 * Class m180412_181831_nuevo_campo_tabla_productos
 */
class m180412_181831_nuevo_campo_tabla_productos extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('productos', 'es_opcion', \yii\db\mysql\Schema::TYPE_BOOLEAN);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m180412_181831_nuevo_campo_tabla_productos cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180412_181831_nuevo_campo_tabla_productos cannot be reverted.\n";

        return false;
    }
    */
}
