<?php

use yii\db\Migration;

/**
 * Class m180419_145627_roles_y_usuarios_iniciales
 */
class m180419_145627_roles_y_usuarios_iniciales extends Migration
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
                    '/admin/*'
                ]
            ];
            $rolAdmin = new \mdm\admin\models\AuthItem(null);
            $rolAdmin->name = $rol[0];
            $rolAdmin->description = $rol[1];
            $rolAdmin->type = 1;
            $rolAdmin->save();
            $urls = new \mdm\admin\models\AuthItem(null);
            $urls->name = $rol[2][0];
            $urls->type = 2;
            $urls->save();
            $rolAdmin->addChildren($urls);

            $user = \Yii::createObject([
                'class'    => \app\models\User::className(),
                'scenario' => 'create',
                'email'    => 'diegohsanabria@gmail.com',
                'username' => 'diego',
                'password' => '123456',
            ]);
            if (!$user->insert(false)) {
                return false;
            }

            $assingment = new \app\models\Assignment($user->id);
            $assingment->assign($rolAdmin);

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
        echo "m180419_145627_roles_y_usuarios_iniciales cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180419_145627_roles_y_usuarios_iniciales cannot be reverted.\n";

        return false;
    }
    */
}
