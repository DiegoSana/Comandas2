<?php

use yii\db\Migration;

/**
 * Class m180419_155519_menues
 */
class m180419_155519_menues extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        try {

            $query = file_get_contents(dirname(__FILE__).'/'.get_class($this).".sql");

            $this->db->pdo->exec($query);

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
        echo "m180419_155519_menues cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180419_155519_menues cannot be reverted.\n";

        return false;
    }
    */
}
