<?php

use yii\db\Migration;

/**
 * Handles the creation of table `chat`.
 */
class m181128_105354_create_chat_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('chat', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            "task_id" => $this->integer(),
            'message' => $this->string(1024)
        ]);

        $this->addForeignKey('fk_chat_user_id', "chat", "user_id", "user", "id");
        $this->addForeignKey("fk_chat_task_id", "chat", "task_id", "tasks", "id");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('chat');
        $this->dropForeignKey("fk_chat_user_id","chat");
        $this->dropForeignKey("fk_chat_task_id", "chat");
    }
}
