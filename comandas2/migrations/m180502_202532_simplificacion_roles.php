<?php

use yii\db\Migration;

/**
 * Class m180502_202532_simplificacion_roles
 */
class m180502_202532_simplificacion_roles extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        try {
            $authManager = Yii::$app->getAuthManager();
            $admin = $authManager->getRole('admin');
            $administrador = $authManager->getRole('administrador');
            $encargado = $authManager->getRole('encargado');
            $authManager->addChild($admin, $administrador);
            $authManager->addChild($administrador, $encargado);

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
        echo "m180502_202532_simplificacion_roles cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180502_202532_simplificacion_roles cannot be reverted.\n";

        return false;
    }
    */
}
