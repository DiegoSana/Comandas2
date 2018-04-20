<?php

use yii\db\Migration;

/**
 * Class m180420_155322_carga_inicial_de_roles
 */
class m180420_155322_carga_inicial_de_roles extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        try {
            $roles = [
                ['administrador','Administrador de empresa',],
                ['encargado','Encargado',],
            ];
            foreach ($roles as $rol) {
                $newrol= new \mdm\admin\models\AuthItem(null);
                $newrol->name = $rol[0];
                $newrol->description = $rol[1];
                $newrol->type = 1;
                $newrol->save();
            }

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
        echo "m180420_155322_carga_inicial_de_roles cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180420_155322_carga_inicial_de_roles cannot be reverted.\n";

        return false;
    }
    */
}
