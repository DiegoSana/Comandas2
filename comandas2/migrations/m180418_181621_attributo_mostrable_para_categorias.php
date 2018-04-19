<?php

use yii\db\Migration;

/**
 * Class m180418_181621_attributo_mostrable_para_categorias
 */
class m180418_181621_attributo_mostrable_para_categorias extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        try {
            $this->addColumn('categorias', 'mostrable', \yii\db\mysql\Schema::TYPE_BOOLEAN);
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
        echo "m180418_181621_attributo_mostrable_para_categorias cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180418_181621_attributo_mostrable_para_categorias cannot be reverted.\n";

        return false;
    }
    */
}
