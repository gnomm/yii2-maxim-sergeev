<?php

use yii\db\Migration;

/**
 * Handles the creation of table `telegram_sp`.
 */
class m181206_130255_create_telegram_sp_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('telegram_sp', [
            'id' => $this->primaryKey(),
            'telegram_id_user' => $this->integer()->unique(),
            'timestamp_offset' => $this->timestamp()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('telegram_sp');
    }
}
