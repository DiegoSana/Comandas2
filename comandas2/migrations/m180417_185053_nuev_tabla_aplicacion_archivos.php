<?php

use yii\db\Migration;

/**
 * Class m180417_185053_nuev_tabla_aplicacion_archivos
 */
class m180417_185053_nuev_tabla_aplicacion_archivos extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        try {
            $this->createTable('aplicacion_archivos', [
                'id' => \yii\db\mysql\Schema::TYPE_PK,
                'nombre' => \yii\db\mysql\Schema::TYPE_STRING,
                'path' => \yii\db\mysql\Schema::TYPE_STRING,
                'type' => \yii\db\mysql\Schema::TYPE_STRING,
                'size' => \yii\db\mysql\Schema::TYPE_INTEGER,
                'aplicacion_id' => \yii\db\mysql\Schema::TYPE_INTEGER,
                'key' => \yii\db\mysql\Schema::TYPE_STRING
            ]);
            $this->addForeignKey('aplicacion_archivos_aplicacion_fk', 'aplicacion_archivos', 'aplicacion_id', 'aplicacion', 'id');
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
        echo "m180417_185053_nuev_tabla_aplicacion_archivos cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180417_185053_nuev_tabla_aplicacion_archivos cannot be reverted.\n";

        return false;
    }
    */
}
