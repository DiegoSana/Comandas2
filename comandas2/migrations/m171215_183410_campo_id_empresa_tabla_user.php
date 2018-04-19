<?php

use yii\db\Migration;

/**
 * Class m171215_183410_campo_id_empresa_tabla_user
 */
class m171215_183410_campo_id_empresa_tabla_user extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('user', 'empresa_id', 'int(11)');
        $this->addForeignKey('users_empresa_fk', 'user', 'empresa_id', 'empresa', 'id');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m171215_183410_campo_id_empresa_tabla_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171215_183410_campo_id_empresa_tabla_user cannot be reverted.\n";

        return false;
    }
    */
}
