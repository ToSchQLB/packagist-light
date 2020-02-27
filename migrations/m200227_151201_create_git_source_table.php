<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%git_source}}`.
 */
class m200227_151201_create_git_source_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%git_source}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull(),
            'baseUrl' => $this->string(100)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%git_source}}');
    }
}
