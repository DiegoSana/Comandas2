<?php

use yii\db\Migration;

/**
 * Class m171213_222237_dbdump
 */
class m171213_222237_dbdump extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $query = file_get_contents(dirname(__FILE__).'/Dump20171213.sql');

        $this->db->pdo->exec($query);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m171213_222237_dbdump cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171213_222237_dbdump cannot be reverted.\n";

        return false;
    }
    */
}
