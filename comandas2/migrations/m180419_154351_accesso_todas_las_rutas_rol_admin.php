<?php

use yii\db\Migration;

/**
 * Class m180419_154351_accesso_todas_las_rutas_rol_admin
 */
class m180419_154351_accesso_todas_las_rutas_rol_admin extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        try {

            $rol = [
                'admin',
                'Administrador',
                [
                    '/admin/*',
                    '/*'
                ]
            ];
            $rolAdmin = \mdm\admin\models\AuthItem::find($rol[0]);
            $urls = new \mdm\admin\models\AuthItem(null);
            $urls->name = $rol[2][1];
            $urls->type = 2;
            $urls->save();
            $rolAdmin->addChildren($urls);
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
        echo "m180419_154351_accesso_todas_las_rutas_rol_admin cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180419_154351_accesso_todas_las_rutas_rol_admin cannot be reverted.\n";

        return false;
    }
    */
}
