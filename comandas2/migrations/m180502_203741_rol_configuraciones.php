<?php

use yii\db\Migration;

/**
 * Class m180502_203741_rol_configuraciones
 */
class m180502_203741_rol_configuraciones extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $urls = new \mdm\admin\models\AuthItem(null);
        $urls->name = '/configuraciones/*';
        $urls->type = 2;
        $urls->save();

        $autMahager = Yii::$app->authManager;
        $adm = $autMahager->getRole('administrador');
        $autMahager->addChild($adm, $urls);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m180502_203741_rol_configuraciones cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180502_203741_rol_configuraciones cannot be reverted.\n";

        return false;
    }
    */
}
