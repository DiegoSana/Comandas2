<?php

use yii\db\Migration;

/**
 * Class m171218_205833_nuevos_campo_productos_has_imagenes
 */
class m171218_205833_nuevos_campo_productos_has_imagenes extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('productos_imagenes','path','VARCHAR(45)');
        $this->addColumn('productos_imagenes','type','VARCHAR(45)');
        $this->addColumn('productos_imagenes','size','INT(11)');
        $this->dropColumn('productos_imagenes','producto_id');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m171218_205833_nuevos_campo_productos_has_imagenes cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171218_205833_nuevos_campo_productos_has_imagenes cannot be reverted.\n";

        return false;
    }
    */
}
