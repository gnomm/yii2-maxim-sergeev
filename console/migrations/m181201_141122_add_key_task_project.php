<?php

use yii\db\Migration;

/**
 * Class m181201_141122_add_key_task_project
 */
class m181201_141122_add_key_task_project extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey('fk_task_project_id', 'tasks', 'project_id', 'project', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181201_141122_add_key_task_project cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181201_141122_add_key_task_project cannot be reverted.\n";

        return false;
    }
    */
}
