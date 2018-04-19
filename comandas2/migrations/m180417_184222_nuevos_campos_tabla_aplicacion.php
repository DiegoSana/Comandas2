<?php

use yii\db\Migration;

/**
 * Class m180417_184222_nuevos_campos_tabla_aplicacion
 */
class m180417_184222_nuevos_campos_tabla_aplicacion extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        try {
            $this->addColumn('aplicacion', 'dominio', \yii\db\mysql\Schema::TYPE_STRING);
            return true;
        } catch (Exception $e) {
            var_dump($e->getMessage());
            return false;
        }
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m180417_184222_nuevos_campos_tabla_aplicacion cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180417_184222_nuevos_campos_tabla_aplicacion cannot be reverted.\n";

        return false;
    }
    */
}
