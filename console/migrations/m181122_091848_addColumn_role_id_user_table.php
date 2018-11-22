<?php

use yii\db\Migration;

/**
 * Class m181122_091848_addColumn_role_id_user_table
 */
class m181122_091848_addColumn_role_id_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', "role_id", $this->integer()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181122_091848_addColumn_role_id_user_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181122_091848_addColumn_role_id_user_table cannot be reverted.\n";

        return false;
    }
    */
}
