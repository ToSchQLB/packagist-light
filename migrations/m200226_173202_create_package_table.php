<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%package}}`.
 */
class m200226_173202_create_package_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%package}}', [
            'id' => $this->primaryKey(),
            'private' => $this->tinyInteger()->defaultValue(0),
            'name' => $this->string(255)->notNull(),
            'url' => $this->string(255),
            'route' => $this->string(255),
            'repo_user' => $this->string(255),
            'repo_name' => $this->string(255),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%package}}');
    }
}
